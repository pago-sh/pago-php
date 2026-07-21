<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\Unauthorized as UnauthorizedModel;
use Throwable;

/**
 * Not authorized to manage license key.
 *
 * Raised when the API responds with HTTP 401.
 */
final class Unauthorized extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?UnauthorizedModel $error;

    public function __construct(int $statusCode = 401, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Not authorized to manage license key.');

        $decoded = null;

        try {
            $decoded = UnauthorizedModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}