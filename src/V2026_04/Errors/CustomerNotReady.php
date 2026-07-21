<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\CustomerNotReady as CustomerNotReadyModel;
use Throwable;

/**
 * Customer is not ready to confirm a payment method.
 *
 * Raised when the API responds with HTTP 400.
 */
final class CustomerNotReady extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?CustomerNotReadyModel $error;

    public function __construct(int $statusCode = 400, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Customer is not ready to confirm a payment method.');

        $decoded = null;

        try {
            $decoded = CustomerNotReadyModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}