<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;

/**
 * The checkout is expired, the customer already has an active subscription, or the organization is not ready to accept payments.
 *
 * Raised when the API responds with HTTP 403.
 */
final class ClientConfirm403Error extends PagoApiException
{
    public function __construct(int $statusCode = 403, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'The checkout is expired, the customer already has an active subscription, or the organization is not ready to accept payments.');
    }
}