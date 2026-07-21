<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\OrderNotEligibleForRetry as OrderNotEligibleForRetryModel;
use Throwable;

/**
 * Order not eligible for retry or payment confirmation failed.
 *
 * Raised when the API responds with HTTP 422.
 */
final class OrderNotEligibleForRetry extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?OrderNotEligibleForRetryModel $error;

    public function __construct(int $statusCode = 422, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Order not eligible for retry or payment confirmation failed.');

        $decoded = null;

        try {
            $decoded = OrderNotEligibleForRetryModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}