<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\HTTPValidationError as HTTPValidationErrorModel;
use Throwable;

/**
 * Validation Error
 *
 * Raised when the API responds with HTTP 422.
 */
final class HTTPValidationError extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?HTTPValidationErrorModel $error;

    public function __construct(int $statusCode = 422, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Validation Error');

        $decoded = null;

        try {
            $decoded = HTTPValidationErrorModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}