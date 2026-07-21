<?php

declare(strict_types=1);

namespace Pago\Exception;

/**
 * The Pago API responded with a 5xx status code.
 */
final class PagoServerException extends PagoException
{
    public function __construct(
        public readonly int $statusCode,
        public readonly string $body,
    ) {
        parent::__construct(
            sprintf('Pago API returned a server error: %d - %s', $statusCode, $body),
        );
    }
}