<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * SubscriptionUncanceledMetadata
 */
final class SubscriptionUncanceledMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $subscription_id,
        public readonly string $product_id,
        public readonly int $amount,
        public readonly string $currency,
        public readonly string $recurring_interval,
        public readonly int $recurring_interval_count,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $subscription_id = Json::toString(Json::get($data, 'subscription_id'));
        $product_id = Json::toString(Json::get($data, 'product_id'));
        $amount = Json::toInt(Json::get($data, 'amount'));
        $currency = Json::toString(Json::get($data, 'currency'));
        $recurring_interval = Json::toString(Json::get($data, 'recurring_interval'));
        $recurring_interval_count = Json::toInt(Json::get($data, 'recurring_interval_count'));

        return new self(
            subscription_id: $subscription_id,
            product_id: $product_id,
            amount: $amount,
            currency: $currency,
            recurring_interval: $recurring_interval,
            recurring_interval_count: $recurring_interval_count,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['subscription_id'] = Json::encode($this->subscription_id);
        $data['product_id'] = Json::encode($this->product_id);
        $data['amount'] = Json::encode($this->amount);
        $data['currency'] = Json::encode($this->currency);
        $data['recurring_interval'] = Json::encode($this->recurring_interval);
        $data['recurring_interval_count'] = Json::encode($this->recurring_interval_count);

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