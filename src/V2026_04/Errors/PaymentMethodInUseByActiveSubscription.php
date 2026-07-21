<?php

declare(strict_types=1);

namespace Pago\V2026_04\Errors;

use Pago\Exception\PagoApiException;
use Pago\Serialization\Json;
use Pago\V2026_04\Models\PaymentMethodInUseByActiveSubscription as PaymentMethodInUseByActiveSubscriptionModel;
use Throwable;

/**
 * Payment method is used by active subscription(s).
 *
 * Raised when the API responds with HTTP 400.
 */
final class PaymentMethodInUseByActiveSubscription extends PagoApiException
{
    /**
     * The decoded error body, or `null` when it did not match the schema.
     */
    public readonly ?PaymentMethodInUseByActiveSubscriptionModel $error;

    public function __construct(int $statusCode = 400, mixed $body = null)
    {
        parent::__construct($statusCode, $body, 'Payment method is used by active subscription(s).');

        $decoded = null;

        try {
            $decoded = PaymentMethodInUseByActiveSubscriptionModel::fromArray(Json::toMap($body));
        } catch (Throwable) {
            $decoded = null;
        }

        $this->error = $decoded;
    }
}