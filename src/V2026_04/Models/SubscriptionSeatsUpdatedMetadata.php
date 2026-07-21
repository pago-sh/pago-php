<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * SubscriptionSeatsUpdatedMetadata
 */
final class SubscriptionSeatsUpdatedMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $subscription_id,
        public readonly int $old_seats,
        public readonly int $new_seats,
        public readonly string $proration_behavior,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $subscription_id = Json::toString(Json::get($data, 'subscription_id'));
        $old_seats = Json::toInt(Json::get($data, 'old_seats'));
        $new_seats = Json::toInt(Json::get($data, 'new_seats'));
        $proration_behavior = Json::toString(Json::get($data, 'proration_behavior'));

        return new self(
            subscription_id: $subscription_id,
            old_seats: $old_seats,
            new_seats: $new_seats,
            proration_behavior: $proration_behavior,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['subscription_id'] = Json::encode($this->subscription_id);
        $data['old_seats'] = Json::encode($this->old_seats);
        $data['new_seats'] = Json::encode($this->new_seats);
        $data['proration_behavior'] = Json::encode($this->proration_behavior);

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