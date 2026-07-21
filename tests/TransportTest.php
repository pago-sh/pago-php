<?php

declare(strict_types=1);

namespace Pago\Tests;

use Nyholm\Psr7\Factory\Psr17Factory;
use Pago\Exception\PagoApiException;
use Pago\Exception\PagoNetworkException;
use Pago\Exception\PagoRateLimitException;
use Pago\Exception\PagoServerException;
use Pago\Http\Transport;
use Pago\Tests\Support\StubHttpClient;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use RuntimeException;

#[CoversClass(Transport::class)]
final class TransportTest extends TestCase
{
    private StubHttpClient $httpClient;

    private Transport $transport;

    protected function setUp(): void
    {
        $factory = new Psr17Factory();
        $this->httpClient = new StubHttpClient();
        $this->transport = new Transport(
            $this->httpClient,
            $factory,
            $factory,
            'https://api.example.test',
            'test-token',
            '2026-04',
        );
    }

    public function testSendsAuthenticationAndVersionHeaders(): void
    {
        $this->httpClient->queueJson(200, ['id' => 'abc']);

        $result = $this->transport->request('GET', '/v1/orders');

        self::assertSame(['id' => 'abc'], $result);

        $request = $this->httpClient->lastRequest();
        self::assertSame('GET', $request->getMethod());
        self::assertSame('Bearer test-token', $request->getHeaderLine('Authorization'));
        self::assertSame('2026-04', $request->getHeaderLine('Pago-Version'));
        self::assertSame('https://api.example.test/v1/orders', (string) $request->getUri());
    }

    public function testInterpolatesPathParameters(): void
    {
        $this->httpClient->queueJson(200, []);

        $this->transport->request('GET', '/v1/orders/{id}', ['id' => 'ord 1/2']);

        self::assertSame(
            'https://api.example.test/v1/orders/ord%201%2F2',
            (string) $this->httpClient->lastRequest()->getUri(),
        );
    }

    public function testBuildsQueryStringAndSkipsNulls(): void
    {
        $this->httpClient->queueJson(200, []);

        $this->transport->request('GET', '/v1/orders', [], [
            'page' => 2,
            'limit' => null,
            'status' => ['open', 'paid'],
            'active' => true,
            'metadata' => ['tier' => 'gold'],
        ]);

        self::assertSame(
            'page=2&status=open&status=paid&active=true&metadata%5Btier%5D=gold',
            $this->httpClient->lastRequest()->getUri()->getQuery(),
        );
    }

    public function testSendsJsonBody(): void
    {
        $this->httpClient->queueJson(201, ['id' => 'new']);

        $this->transport->request('POST', '/v1/orders', [], [], ['amount' => 100]);

        $request = $this->httpClient->lastRequest();
        self::assertSame('application/json', $request->getHeaderLine('Content-Type'));
        self::assertSame('{"amount":100}', (string) $request->getBody());
    }

    public function testTextResponseIsReturnedRaw(): void
    {
        $this->httpClient->queue(200, 'id,amount');

        self::assertSame(
            'id,amount',
            $this->transport->request('GET', '/v1/export', [], [], null, 'text'),
        );
    }

    public function testNoneResponseIsNull(): void
    {
        $this->httpClient->queue(204);

        self::assertNull(
            $this->transport->request('DELETE', '/v1/orders/1', [], [], null, 'none'),
        );
    }

    public function testServerErrorRaisesServerException(): void
    {
        $this->httpClient->queue(503, 'upstream down');

        $this->expectException(PagoServerException::class);

        $this->transport->request('GET', '/v1/orders');
    }

    public function testClientErrorRaisesApiException(): void
    {
        $this->httpClient->queueJson(400, ['detail' => 'bad request']);

        try {
            $this->transport->request('GET', '/v1/orders');
            self::fail('Expected a PagoApiException.');
        } catch (PagoApiException $exception) {
            self::assertSame(400, $exception->statusCode);
            self::assertSame(['detail' => 'bad request'], $exception->body);
        }
    }

    public function testRateLimitErrorExposesRetryAfter(): void
    {
        $this->httpClient->queue(429, '', ['Retry-After' => '30']);

        try {
            $this->transport->request('GET', '/v1/orders');
            self::fail('Expected a PagoRateLimitException.');
        } catch (PagoRateLimitException $exception) {
            self::assertSame(429, $exception->statusCode);
            self::assertSame(30, $exception->retryAfter);
        }
    }

    public function testMappedErrorClassIsUsed(): void
    {
        $this->httpClient->queueJson(404, ['detail' => 'missing']);

        $this->expectException(NotFoundStub::class);

        $this->transport->request('GET', '/v1/orders', [], [], null, 'json', [
            404 => NotFoundStub::class,
        ]);
    }

    public function testTransportFailureRaisesNetworkException(): void
    {
        $this->httpClient->throwOnSend(new class extends RuntimeException implements ClientExceptionInterface {});

        $this->expectException(PagoNetworkException::class);

        $this->transport->request('GET', '/v1/orders');
    }
}

final class NotFoundStub extends PagoApiException
{
}