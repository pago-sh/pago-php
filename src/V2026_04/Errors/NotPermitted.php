<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\NotPermitted as NotPermittedModel;
use Throwable;

/**
 * You don't have the permission to update this organization.
 *
 * Raised when the API responds with HTTP 403.
 */
final class NotPermitted extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?NotPermittedModel $error;

    public function __construct(int $statusCode = 403, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'You don\'t have the permission to update this organization.');

        $decoded = null;

        try {
            $decoded = NotPermittedModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}