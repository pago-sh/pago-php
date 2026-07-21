<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;

/**
 * Seat-based pricing not enabled for organization
 *
 * Raised when the API responds with HTTP 403.
 */
final class GetClaimInfo403Error extends PagoApiException
{
    public function __construct(int $statusCode = 403, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Seat-based pricing not enabled for organization');
    }
}