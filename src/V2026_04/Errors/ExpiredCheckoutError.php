<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\ExpiredCheckoutError as ExpiredCheckoutErrorModel;
use Throwable;

/**
 * The checkout session is expired.
 *
 * Raised when the API responds with HTTP 410.
 */
final class ExpiredCheckoutError extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?ExpiredCheckoutErrorModel $error;

    public function __construct(int $statusCode = 410, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'The checkout session is expired.');

        $decoded = null;

        try {
            $decoded = ExpiredCheckoutErrorModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}