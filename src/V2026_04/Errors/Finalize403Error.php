<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;

/**
 * Off-session charges are not enabled for this organization, or its account can't currently accept payments.
 *
 * Raised when the API responds with HTTP 403.
 */
final class Finalize403Error extends PagoApiException
{
    public function __construct(int $statusCode = 403, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Off-session charges are not enabled for this organization, or its account can\'t currently accept payments.');
    }
}