<?php

declare(strict_types=1);

namespace Pago\Tests\Support;

use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * An in-memory PSR-18 client: queue responses, inspect the requests that were
 * sent. Keeps the test-suite free of network access.
 */
final class StubHttpClient implements ClientInterface
{
    /** @var list<RequestInterface> */
    public array $requests = [];

    /** @var list<ResponseInterface> */
    private array $responses = [];

    private ?ClientExceptionInterface $exception = null;

    /**
     * @param array<string, string> $headers
     */
    public function queue(int $statusCode, string $body = '', array $headers = []): self
    {
        $this->responses[] = new Response($statusCode, $headers, $body);

        return $this;
    }

    public function queueJson(int $statusCode, mixed $payload): self
    {
        return $this->queue(
            $statusCode,
            json_encode($payload, JSON_THROW_ON_ERROR),
            ['Content-Type' => 'application/json'],
        );
    }

    public function throwOnSend(ClientExceptionInterface $exception): self
    {
        $this->exception = $exception;

        return $this;
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->requests[] = $request;

        if ($this->exception !== null) {
            throw $this->exception;
        }

        $response = array_shift($this->responses);
        if ($response === null) {
            return new Response(204);
        }

        return $response;
    }

    public function lastRequest(): RequestInterface
    {
        $request = end($this->requests);
        if ($request === false) {
            throw new \LogicException('No request was sent.');
        }

        return $request;
    }
}