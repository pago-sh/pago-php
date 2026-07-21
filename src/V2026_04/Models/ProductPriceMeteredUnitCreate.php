<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to create a metered price with a fixed unit price.
 */
final class ProductPriceMeteredUnitCreate implements Model, Deserializable
{
    public function __construct(
        public readonly string $amount_type,
        public readonly string $meter_id,
        public readonly float|string $unit_amount,
        /**
         * @var PresentmentCurrency|null
         */
        public readonly ?PresentmentCurrency $price_currency = null,
        /**
         * @var TaxBehaviorOption|null
         */
        public readonly ?TaxBehaviorOption $tax_behavior = null,
        /**
         * @var int|null
         */
        public readonly ?int $cap_amount = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $amount_type = Json::toString(Json::get($data, 'amount_type'));
        $meter_id = Json::toString(Json::get($data, 'meter_id'));
        /** @var float|string $unit_amount */
        $unit_amount = Json::get($data, 'unit_amount');
        /** @var PresentmentCurrency|null $price_currency */
        $price_currency = isset($data['price_currency']) ? PresentmentCurrency::from(Json::toString($data['price_currency'])) : null;
        /** @var TaxBehaviorOption|null $tax_behavior */
        $tax_behavior = isset($data['tax_behavior']) ? TaxBehaviorOption::from(Json::toString($data['tax_behavior'])) : null;
        /** @var int|null $cap_amount */
        $cap_amount = isset($data['cap_amount']) ? Json::toInt($data['cap_amount']) : null;

        return new self(
            amount_type: $amount_type,
            meter_id: $meter_id,
            unit_amount: $unit_amount,
            price_currency: $price_currency,
            tax_behavior: $tax_behavior,
            cap_amount: $cap_amount,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['amount_type'] = Json::encode($this->amount_type);
        $data['meter_id'] = Json::encode($this->meter_id);
        $data['unit_amount'] = Json::encode($this->unit_amount);
        if ($this->price_currency !== null) {
            $data['price_currency'] = Json::encode($this->price_currency);
        }
        if ($this->tax_behavior !== null) {
            $data['tax_behavior'] = Json::encode($this->tax_behavior);
        }
        if ($this->cap_amount !== null) {
            $data['cap_amount'] = Json::encode($this->cap_amount);
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