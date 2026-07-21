<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * SubscriptionRevokedMetadata
 */
final class SubscriptionRevokedMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $subscription_id,
        /**
         * @var string|null
         */
        public readonly ?string $product_id = null,
        /**
         * @var int|null
         */
        public readonly ?int $amount = null,
        /**
         * @var string|null
         */
        public readonly ?string $currency = null,
        /**
         * @var string|null
         */
        public readonly ?string $recurring_interval = null,
        /**
         * @var int|null
         */
        public readonly ?int $recurring_interval_count = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $subscription_id = Json::toString(Json::get($data, 'subscription_id'));
        /** @var string|null $product_id */
        $product_id = isset($data['product_id']) ? Json::toString($data['product_id']) : null;
        /** @var int|null $amount */
        $amount = isset($data['amount']) ? Json::toInt($data['amount']) : null;
        /** @var string|null $currency */
        $currency = isset($data['currency']) ? Json::toString($data['currency']) : null;
        /** @var string|null $recurring_interval */
        $recurring_interval = isset($data['recurring_interval']) ? Json::toString($data['recurring_interval']) : null;
        /** @var int|null $recurring_interval_count */
        $recurring_interval_count = isset($data['recurring_interval_count']) ? Json::toInt($data['recurring_interval_count']) : null;

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
        if ($this->product_id !== null) {
            $data['product_id'] = Json::encode($this->product_id);
        }
        if ($this->amount !== null) {
            $data['amount'] = Json::encode($this->amount);
        }
        if ($this->currency !== null) {
            $data['currency'] = Json::encode($this->currency);
        }
        if ($this->recurring_interval !== null) {
            $data['recurring_interval'] = Json::encode($this->recurring_interval);
        }
        if ($this->recurring_interval_count !== null) {
            $data['recurring_interval_count'] = Json::encode($this->recurring_interval_count);
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