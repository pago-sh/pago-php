<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;

/**
 * Subscription or order not found
 *
 * Raised when the API responds with HTTP 404.
 */
final class ListSeats404Error extends PagoApiException
{
    public function __construct(int $statusCode = 404, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Subscription or order not found');
    }
}