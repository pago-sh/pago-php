<?php

declare(strict_types=1);

namespace Pago\Exception;

/**
 * The Pago API responded with 429 Too Many Requests.
 */
final class PagoRateLimitException extends PagoApiException
{
    public function __construct(
        int $statusCode,
        mixed $body = null,
        public readonly ?int $retryAfter = null,
    ) {
        parent::__construct(
            $statusCode,
            $body,
            $retryAfter === null
                ? 'Pago API rate limit exceeded.'
                : sprintf('Pago API rate limit exceeded. Retry after %d seconds.', $retryAfter),
        );
    }
}