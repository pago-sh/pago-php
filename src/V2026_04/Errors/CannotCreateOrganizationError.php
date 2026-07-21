<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\CannotCreateOrganizationError as CannotCreateOrganizationErrorModel;
use Throwable;

/**
 * Forbidden
 *
 * Raised when the API responds with HTTP 403.
 */
final class CannotCreateOrganizationError extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?CannotCreateOrganizationErrorModel $error;

    public function __construct(int $statusCode = 403, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Forbidden');

        $decoded = null;

        try {
            $decoded = CannotCreateOrganizationErrorModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}