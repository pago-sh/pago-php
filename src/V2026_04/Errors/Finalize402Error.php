<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;

/**
 * The charge failed, or requires customer authentication (e.g. a 3DS challenge) that can't be completed off-session.
 *
 * Raised when the API responds with HTTP 402.
 */
final class Finalize402Error extends PagoApiException
{
    public function __construct(int $statusCode = 402, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'The charge failed, or requires customer authentication (e.g. a 3DS challenge) that can\'t be completed off-session.');
    }
}