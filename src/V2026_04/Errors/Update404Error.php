<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;

/**
 * Not Found
 *
 * Raised when the API responds with HTTP 404.
 */
final class Update404Error extends PagoApiException
{
    public function __construct(int $statusCode = 404, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Not Found');
    }
}