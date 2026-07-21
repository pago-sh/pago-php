<?php

declare(strict_types=1);

namespace Pago\Http;

use Pago\Exception\PagoApiException;
use Pago\Exception\PagoNetworkException;
use Pago\Exception\PagoRateLimitException;
use Pago\Exception\PagoServerException;
use Pago\Serialization\Json;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Turns generated service calls into PSR-7 requests and back.
 */
final class Transport
{
    public function __construct(
        private readonly ClientInterface $httpClient,
        private readonly RequestFactoryInterface $requestFactory,
        private readonly StreamFactoryInterface $streamFactory,
        private readonly string $baseUrl,
        private readonly string $accessToken,
        private readonly string $apiVersion,
    ) {
    }

    /**
     * @param array<string, mixed>                          $pathParams
     * @param array<string, mixed>                          $queryParams
     * @param array<int, class-string<PagoApiException>>    $errors      status code => exception class
     *
     * @return mixed decoded JSON for `json`, the raw body for `text`, `null` for `none`
     */
    public function request(
        string $method,
        string $path,
        array $pathParams = [],
        array $queryParams = [],
        mixed $body = null,
        string $responseType = 'json',
        array $errors = [],
    ): mixed {
        $url = $this->baseUrl . $this->interpolate($path, $pathParams);
        $query = $this->buildQuery($queryParams);
        if ($query !== '') {
            $url .= '?' . $query;
        }

        $request = $this->requestFactory->createRequest($method, $url)
            ->withHeader('Accept', 'application/json')
            ->withHeader('Authorization', 'Bearer ' . $this->accessToken)
            ->withHeader('Pago-Version', $this->apiVersion);

        if ($body !== null) {
            $request = $request
                ->withHeader('Content-Type', 'application/json')
                ->withBody($this->streamFactory->createStream(Json::stringify($body)));
        }

        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $exception) {
            throw new PagoNetworkException(
                'Pago API network error: ' . $exception->getMessage(),
                previous: $exception,
            );
        }

        $statusCode = $response->getStatusCode();
        $payload = (string) $response->getBody();

        if ($statusCode >= 500) {
            throw new PagoServerException($statusCode, $payload === '' ? 'Server error' : $payload);
        }

        if ($statusCode >= 400) {
            $decoded = $payload === '' ? null : $this->tryDecode($payload);

            if ($statusCode === 429) {
                $retryAfter = $response->getHeaderLine('Retry-After');
                throw new PagoRateLimitException(
                    $statusCode,
                    $decoded ?? $payload,
                    is_numeric($retryAfter) ? (int) $retryAfter : null,
                );
            }

            if (isset($errors[$statusCode])) {
                $errorClass = $errors[$statusCode];
                throw new $errorClass($statusCode, $decoded ?? $payload);
            }

            throw new PagoApiException($statusCode, $decoded ?? $payload);
        }

        return match ($responseType) {
            'json' => $payload === '' ? null : Json::decode($payload),
            'text' => $payload,
            default => null,
        };
    }

    /**
     * @param array<string, mixed> $pathParams
     */
    private function interpolate(string $path, array $pathParams): string
    {
        foreach ($pathParams as $key => $value) {
            if ($value === null) {
                continue;
            }

            $path = str_replace(
                '{' . $key . '}',
                rawurlencode($this->stringify($value)),
                $path,
            );
        }

        return $path;
    }

    /**
     * @param array<string, mixed> $queryParams
     */
    private function buildQuery(array $queryParams): string
    {
        $pairs = [];

        foreach ($queryParams as $key => $value) {
            if ($value === null) {
                continue;
            }

            if (is_array($value)) {
                if (array_is_list($value)) {
                    foreach ($value as $item) {
                        if ($item === null) {
                            continue;
                        }
                        $pairs[] = rawurlencode($key) . '=' . rawurlencode($this->stringify($item));
                    }

                    continue;
                }

                // `deepObject` style, e.g. metadata[key]=value
                foreach ($value as $subKey => $subValue) {
                    if ($subValue === null) {
                        continue;
                    }
                    if (is_array($subValue)) {
                        foreach ($subValue as $item) {
                            if ($item === null) {
                                continue;
                            }
                            $pairs[] = rawurlencode($key . '[' . $subKey . ']')
                                . '=' . rawurlencode($this->stringify($item));
                        }

                        continue;
                    }
                    $pairs[] = rawurlencode($key . '[' . $subKey . ']')
                        . '=' . rawurlencode($this->stringify($subValue));
                }

                continue;
            }

            $pairs[] = rawurlencode($key) . '=' . rawurlencode($this->stringify($value));
        }

        return implode('&', $pairs);
    }

    private function stringify(mixed $value): string
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_string($value)) {
            return $value;
        }
        if (is_int($value) || is_float($value)) {
            return (string) $value;
        }

        return Json::stringify($value);
    }

    private function tryDecode(string $payload): mixed
    {
        return json_decode($payload, true);
    }
}