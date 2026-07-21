<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * SubscriptionCanceledMetadata
 */
final class SubscriptionCanceledMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $subscription_id,
        public readonly int $amount,
        public readonly string $currency,
        public readonly string $recurring_interval,
        public readonly int $recurring_interval_count,
        public readonly string $canceled_at,
        /**
         * @var string|null
         */
        public readonly ?string $product_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $customer_cancellation_reason = null,
        /**
         * @var string|null
         */
        public readonly ?string $customer_cancellation_comment = null,
        /**
         * @var string|null
         */
        public readonly ?string $ends_at = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $cancel_at_period_end = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $subscription_id = Json::toString(Json::get($data, 'subscription_id'));
        $amount = Json::toInt(Json::get($data, 'amount'));
        $currency = Json::toString(Json::get($data, 'currency'));
        $recurring_interval = Json::toString(Json::get($data, 'recurring_interval'));
        $recurring_interval_count = Json::toInt(Json::get($data, 'recurring_interval_count'));
        $canceled_at = Json::toString(Json::get($data, 'canceled_at'));
        /** @var string|null $product_id */
        $product_id = isset($data['product_id']) ? Json::toString($data['product_id']) : null;
        /** @var string|null $customer_cancellation_reason */
        $customer_cancellation_reason = isset($data['customer_cancellation_reason']) ? Json::toString($data['customer_cancellation_reason']) : null;
        /** @var string|null $customer_cancellation_comment */
        $customer_cancellation_comment = isset($data['customer_cancellation_comment']) ? Json::toString($data['customer_cancellation_comment']) : null;
        /** @var string|null $ends_at */
        $ends_at = isset($data['ends_at']) ? Json::toString($data['ends_at']) : null;
        /** @var bool|null $cancel_at_period_end */
        $cancel_at_period_end = isset($data['cancel_at_period_end']) ? Json::toBool($data['cancel_at_period_end']) : null;

        return new self(
            subscription_id: $subscription_id,
            amount: $amount,
            currency: $currency,
            recurring_interval: $recurring_interval,
            recurring_interval_count: $recurring_interval_count,
            canceled_at: $canceled_at,
            product_id: $product_id,
            customer_cancellation_reason: $customer_cancellation_reason,
            customer_cancellation_comment: $customer_cancellation_comment,
            ends_at: $ends_at,
            cancel_at_period_end: $cancel_at_period_end,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['subscription_id'] = Json::encode($this->subscription_id);
        $data['amount'] = Json::encode($this->amount);
        $data['currency'] = Json::encode($this->currency);
        $data['recurring_interval'] = Json::encode($this->recurring_interval);
        $data['recurring_interval_count'] = Json::encode($this->recurring_interval_count);
        $data['canceled_at'] = Json::encode($this->canceled_at);
        if ($this->product_id !== null) {
            $data['product_id'] = Json::encode($this->product_id);
        }
        if ($this->customer_cancellation_reason !== null) {
            $data['customer_cancellation_reason'] = Json::encode($this->customer_cancellation_reason);
        }
        if ($this->customer_cancellation_comment !== null) {
            $data['customer_cancellation_comment'] = Json::encode($this->customer_cancellation_comment);
        }
        if ($this->ends_at !== null) {
            $data['ends_at'] = Json::encode($this->ends_at);
        }
        if ($this->cancel_at_period_end !== null) {
            $data['cancel_at_period_end'] = Json::encode($this->cancel_at_period_end);
        }

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}