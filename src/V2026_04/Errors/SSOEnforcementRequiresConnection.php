<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\SSOEnforcementRequiresConnection as SSOEnforcementRequiresConnectionModel;
use Throwable;

/**
 * Cannot enforce SSO without an enabled connection.
 *
 * Raised when the API responds with HTTP 409.
 */
final class SSOEnforcementRequiresConnection extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?SSOEnforcementRequiresConnectionModel $error;

    public function __construct(int $statusCode = 409, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Cannot enforce SSO without an enabled connection.');

        $decoded = null;

        try {
            $decoded = SSOEnforcementRequiresConnectionModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}