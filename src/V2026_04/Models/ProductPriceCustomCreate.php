<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to create a pay-what-you-want price.
 */
final class ProductPriceCustomCreate implements Model, Deserializable
{
    public function __construct(
        public readonly string $amount_type,
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
        public readonly ?int $minimum_amount = null,
        /**
         * @var int|null
         */
        public readonly ?int $maximum_amount = null,
        /**
         * @var int|null
         */
        public readonly ?int $preset_amount = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $amount_type = Json::toString(Json::get($data, 'amount_type'));
        /** @var PresentmentCurrency|null $price_currency */
        $price_currency = isset($data['price_currency']) ? PresentmentCurrency::from(Json::toString($data['price_currency'])) : null;
        /** @var TaxBehaviorOption|null $tax_behavior */
        $tax_behavior = isset($data['tax_behavior']) ? TaxBehaviorOption::from(Json::toString($data['tax_behavior'])) : null;
        /** @var int|null $minimum_amount */
        $minimum_amount = isset($data['minimum_amount']) ? Json::toInt($data['minimum_amount']) : null;
        /** @var int|null $maximum_amount */
        $maximum_amount = isset($data['maximum_amount']) ? Json::toInt($data['maximum_amount']) : null;
        /** @var int|null $preset_amount */
        $preset_amount = isset($data['preset_amount']) ? Json::toInt($data['preset_amount']) : null;

        return new self(
            amount_type: $amount_type,
            price_currency: $price_currency,
            tax_behavior: $tax_behavior,
            minimum_amount: $minimum_amount,
            maximum_amount: $maximum_amount,
            preset_amount: $preset_amount,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['amount_type'] = Json::encode($this->amount_type);
        if ($this->price_currency !== null) {
            $data['price_currency'] = Json::encode($this->price_currency);
        }
        if ($this->tax_behavior !== null) {
            $data['tax_behavior'] = Json::encode($this->tax_behavior);
        }
        if ($this->minimum_amount !== null) {
            $data['minimum_amount'] = Json::encode($this->minimum_amount);
        }
        if ($this->maximum_amount !== null) {
            $data['maximum_amount'] = Json::encode($this->maximum_amount);
        }
        if ($this->preset_amount !== null) {
            $data['preset_amount'] = Json::encode($this->preset_amount);
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