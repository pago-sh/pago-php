<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;

/**
 * Not permitted - requires owner or billing manager role
 *
 * Raised when the API responds with HTTP 403.
 */
final class RemoveMember403Error extends PagoApiException
{
    public function __construct(int $statusCode = 403, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Not permitted - requires owner or billing manager role');
    }
}