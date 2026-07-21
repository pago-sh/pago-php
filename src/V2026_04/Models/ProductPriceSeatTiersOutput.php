<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * List of pricing tiers for seat-based pricing.
 *
 * The minimum and maximum seat limits are derived from the tiers:
 * - minimum_seats = first tier's min_seats
 * - maximum_seats = last tier's max_seats (None for unlimited)
 */
final class ProductPriceSeatTiersOutput implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<ProductPriceSeatTier>
         */
        public readonly array $tiers,
        public readonly int $minimum_seats,
        /**
         * @var int|null
         */
        public readonly ?int $maximum_seats,
        /**
         * @var SeatTierType|null
         */
        public readonly ?SeatTierType $seat_tier_type = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<ProductPriceSeatTier> $tiers */
        $tiers = array_map(static fn (mixed $item0): ProductPriceSeatTier => ProductPriceSeatTier::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'tiers')));
        $minimum_seats = Json::toInt(Json::get($data, 'minimum_seats'));
        /** @var int|null $maximum_seats */
        $maximum_seats = (Json::get($data, 'maximum_seats') === null ? null : Json::toInt(Json::get($data, 'maximum_seats')));
        /** @var SeatTierType|null $seat_tier_type */
        $seat_tier_type = isset($data['seat_tier_type']) ? SeatTierType::from(Json::toString($data['seat_tier_type'])) : null;

        return new self(
            tiers: $tiers,
            minimum_seats: $minimum_seats,
            maximum_seats: $maximum_seats,
            seat_tier_type: $seat_tier_type,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['tiers'] = Json::encode($this->tiers);
        $data['minimum_seats'] = Json::encode($this->minimum_seats);
        $data['maximum_seats'] = Json::encode($this->maximum_seats);
        if ($this->seat_tier_type !== null) {
            $data['seat_tier_type'] = Json::encode($this->seat_tier_type);
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