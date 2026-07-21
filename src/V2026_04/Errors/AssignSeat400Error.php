<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;

/**
 * No available seats or customer already has a seat
 *
 * Raised when the API responds with HTTP 400.
 */
final class AssignSeat400Error extends PagoApiException
{
    public function __construct(int $statusCode = 400, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'No available seats or customer already has a seat');
    }
}