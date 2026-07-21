<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\PaymentFailed as PaymentFailedModel;
use Throwable;

/**
 * Payment required to apply the subscription update.
 *
 * Raised when the API responds with HTTP 402.
 */
final class PaymentFailed extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?PaymentFailedModel $error;

    public function __construct(int $statusCode = 402, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Payment required to apply the subscription update.');

        $decoded = null;

        try {
            $decoded = PaymentFailedModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}