<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;

/**
 * Seat not found
 *
 * Raised when the API responds with HTTP 404.
 */
final class ResendInvitation404Error extends PagoApiException
{
    public function __construct(int $statusCode = 404, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Seat not found');
    }
}