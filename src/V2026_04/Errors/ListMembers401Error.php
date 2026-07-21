<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;

/**
 * Authentication required
 *
 * Raised when the API responds with HTTP 401.
 */
final class ListMembers401Error extends PagoApiException
{
    public function __construct(int $statusCode = 401, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Authentication required');
    }
}