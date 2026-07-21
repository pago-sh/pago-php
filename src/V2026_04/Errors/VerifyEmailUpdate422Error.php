<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;

/**
 * Email address is already in use.
 *
 * Raised when the API responds with HTTP 422.
 */
final class VerifyEmailUpdate422Error extends PagoApiException
{
    public function __construct(int $statusCode = 422, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Email address is already in use.');
    }
}