<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\AmbiguousExternalCustomerID as AmbiguousExternalCustomerIDModel;
use Throwable;

/**
 * The external customer ID matches customers in several accessible organizations.
 *
 * Raised when the API responds with HTTP 409.
 */
final class AmbiguousExternalCustomerID extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?AmbiguousExternalCustomerIDModel $error;

    public function __construct(int $statusCode = 409, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'The external customer ID matches customers in several accessible organizations.');

        $decoded = null;

        try {
            $decoded = AmbiguousExternalCustomerIDModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}