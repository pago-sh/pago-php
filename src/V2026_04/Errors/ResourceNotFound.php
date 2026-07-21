<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\ResourceNotFound as ResourceNotFoundModel;
use Throwable;

/**
 * Organization not found.
 *
 * Raised when the API responds with HTTP 404.
 */
final class ResourceNotFound extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?ResourceNotFoundModel $error;

    public function __construct(int $statusCode = 404, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Organization not found.');

        $decoded = null;

        try {
            $decoded = ResourceNotFoundModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}