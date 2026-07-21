<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerSubscriptionUpdateSeats
 */
final class CustomerSubscriptionUpdateSeats implements Model, Deserializable, CustomerSubscriptionUpdate
{
    public function __construct(
        public readonly int $seats,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $seats = Json::toInt(Json::get($data, 'seats'));

        return new self(
            seats: $seats,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['seats'] = Json::encode($this->seats);

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