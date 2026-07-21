<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * SubscriptionUpdatedMetadata
 */
final class SubscriptionUpdatedMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $subscription_id,
        /**
         * @var string|null
         */
        public readonly ?string $product_id = null,
        /**
         * @var SubscriptionProrationBehavior|null
         */
        public readonly ?SubscriptionProrationBehavior $proration_behavior = null,
        /**
         * @var string|null
         */
        public readonly ?string $discount_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $trial_end = null,
        /**
         * @var int|null
         */
        public readonly ?int $seats = null,
        /**
         * @var string|null
         */
        public readonly ?string $billing_period_end = null,
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
        /** @var SubscriptionProrationBehavior|null $proration_behavior */
        $proration_behavior = isset($data['proration_behavior']) ? SubscriptionProrationBehavior::from(Json::toString($data['proration_behavior'])) : null;
        /** @var string|null $discount_id */
        $discount_id = isset($data['discount_id']) ? Json::toString($data['discount_id']) : null;
        /** @var string|null $trial_end */
        $trial_end = isset($data['trial_end']) ? Json::toString($data['trial_end']) : null;
        /** @var int|null $seats */
        $seats = isset($data['seats']) ? Json::toInt($data['seats']) : null;
        /** @var string|null $billing_period_end */
        $billing_period_end = isset($data['billing_period_end']) ? Json::toString($data['billing_period_end']) : null;

        return new self(
            subscription_id: $subscription_id,
            product_id: $product_id,
            proration_behavior: $proration_behavior,
            discount_id: $discount_id,
            trial_end: $trial_end,
            seats: $seats,
            billing_period_end: $billing_period_end,
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
        if ($this->proration_behavior !== null) {
            $data['proration_behavior'] = Json::encode($this->proration_behavior);
        }
        if ($this->discount_id !== null) {
            $data['discount_id'] = Json::encode($this->discount_id);
        }
        if ($this->trial_end !== null) {
            $data['trial_end'] = Json::encode($this->trial_end);
        }
        if ($this->seats !== null) {
            $data['seats'] = Json::encode($this->seats);
        }
        if ($this->billing_period_end !== null) {
            $data['billing_period_end'] = Json::encode($this->billing_period_end);
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