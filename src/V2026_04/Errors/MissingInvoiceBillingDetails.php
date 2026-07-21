<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\MissingInvoiceBillingDetails as MissingInvoiceBillingDetailsModel;
use Throwable;

/**
 * Order is missing billing name or address.
 *
 * Raised when the API responds with HTTP 422.
 */
final class MissingInvoiceBillingDetails extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?MissingInvoiceBillingDetailsModel $error;

    public function __construct(int $statusCode = 422, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Order is missing billing name or address.');

        $decoded = null;

        try {
            $decoded = MissingInvoiceBillingDetailsModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}