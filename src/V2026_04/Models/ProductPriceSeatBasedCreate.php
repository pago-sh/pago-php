<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to create a seat-based price with volume-based tiers.
 */
final class ProductPriceSeatBasedCreate implements Model, Deserializable
{
    public function __construct(
        public readonly string $amount_type,
        public readonly ProductPriceSeatTiersInput $seat_tiers,
        /**
         * @var PresentmentCurrency|null
         */
        public readonly ?PresentmentCurrency $price_currency = null,
        /**
         * @var TaxBehaviorOption|null
         */
        public readonly ?TaxBehaviorOption $tax_behavior = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $amount_type = Json::toString(Json::get($data, 'amount_type'));
        $seat_tiers = ProductPriceSeatTiersInput::fromArray(Json::toMap(Json::get($data, 'seat_tiers')));
        /** @var PresentmentCurrency|null $price_currency */
        $price_currency = isset($data['price_currency']) ? PresentmentCurrency::from(Json::toString($data['price_currency'])) : null;
        /** @var TaxBehaviorOption|null $tax_behavior */
        $tax_behavior = isset($data['tax_behavior']) ? TaxBehaviorOption::from(Json::toString($data['tax_behavior'])) : null;

        return new self(
            amount_type: $amount_type,
            seat_tiers: $seat_tiers,
            price_currency: $price_currency,
            tax_behavior: $tax_behavior,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['amount_type'] = Json::encode($this->amount_type);
        $data['seat_tiers'] = Json::encode($this->seat_tiers);
        if ($this->price_currency !== null) {
            $data['price_currency'] = Json::encode($this->price_currency);
        }
        if ($this->tax_behavior !== null) {
            $data['tax_behavior'] = Json::encode($this->tax_behavior);
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