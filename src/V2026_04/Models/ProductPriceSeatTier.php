<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * A pricing tier for seat-based pricing.
 */
final class ProductPriceSeatTier implements Model, Deserializable
{
    public function __construct(
        public readonly int $min_seats,
        public readonly int $price_per_seat,
        /**
         * @var int|null
         */
        public readonly ?int $max_seats = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $min_seats = Json::toInt(Json::get($data, 'min_seats'));
        $price_per_seat = Json::toInt(Json::get($data, 'price_per_seat'));
        /** @var int|null $max_seats */
        $max_seats = isset($data['max_seats']) ? Json::toInt($data['max_seats']) : null;

        return new self(
            min_seats: $min_seats,
            price_per_seat: $price_per_seat,
            max_seats: $max_seats,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['min_seats'] = Json::encode($this->min_seats);
        $data['price_per_seat'] = Json::encode($this->price_per_seat);
        if ($this->max_seats !== null) {
            $data['max_seats'] = Json::encode($this->max_seats);
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