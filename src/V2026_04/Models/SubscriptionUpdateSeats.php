<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * SubscriptionUpdateSeats
 */
final class SubscriptionUpdateSeats implements Model, Deserializable, SubscriptionUpdate
{
    public function __construct(
        public readonly int $seats,
        /**
         * @var SubscriptionProrationBehavior|null
         */
        public readonly ?SubscriptionProrationBehavior $proration_behavior = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $seats = Json::toInt(Json::get($data, 'seats'));
        /** @var SubscriptionProrationBehavior|null $proration_behavior */
        $proration_behavior = isset($data['proration_behavior']) ? SubscriptionProrationBehavior::from(Json::toString($data['proration_behavior'])) : null;

        return new self(
            seats: $seats,
            proration_behavior: $proration_behavior,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['seats'] = Json::encode($this->seats);
        if ($this->proration_behavior !== null) {
            $data['proration_behavior'] = Json::encode($this->proration_behavior);
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