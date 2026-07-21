<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\OrderNotEligibleForInvoice as OrderNotEligibleForInvoiceModel;
use Throwable;

/**
 * Order is not eligible for invoice generation (invalid status).
 *
 * Raised when the API responds with HTTP 409.
 */
final class OrderNotEligibleForInvoice extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?OrderNotEligibleForInvoiceModel $error;

    public function __construct(int $statusCode = 409, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Order is not eligible for invoice generation (invalid status).');

        $decoded = null;

        try {
            $decoded = OrderNotEligibleForInvoiceModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}