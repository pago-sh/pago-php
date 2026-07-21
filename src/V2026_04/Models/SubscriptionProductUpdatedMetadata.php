<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * SubscriptionProductUpdatedMetadata
 */
final class SubscriptionProductUpdatedMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $subscription_id,
        public readonly string $old_product_id,
        public readonly string $new_product_id,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $subscription_id = Json::toString(Json::get($data, 'subscription_id'));
        $old_product_id = Json::toString(Json::get($data, 'old_product_id'));
        $new_product_id = Json::toString(Json::get($data, 'new_product_id'));

        return new self(
            subscription_id: $subscription_id,
            old_product_id: $old_product_id,
            new_product_id: $new_product_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['subscription_id'] = Json::encode($this->subscription_id);
        $data['old_product_id'] = Json::encode($this->old_product_id);
        $data['new_product_id'] = Json::encode($this->new_product_id);

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