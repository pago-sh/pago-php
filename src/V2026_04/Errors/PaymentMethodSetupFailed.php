<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\PaymentMethodSetupFailed as PaymentMethodSetupFailedModel;
use Throwable;

/**
 * The card was declined while setting up the payment method.
 *
 * Raised when the API responds with HTTP 400.
 */
final class PaymentMethodSetupFailed extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?PaymentMethodSetupFailedModel $error;

    public function __construct(int $statusCode = 400, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'The card was declined while setting up the payment method.');

        $decoded = null;

        try {
            $decoded = PaymentMethodSetupFailedModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}