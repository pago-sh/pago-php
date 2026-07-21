<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * A fixed price for a product.
 */
final class ProductPriceFixed implements Model, Deserializable, ProductPrice
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly ProductPriceSource $source,
        public readonly string $amount_type,
        public readonly string $price_currency,
        /**
         * @var TaxBehaviorOption|null
         */
        public readonly ?TaxBehaviorOption $tax_behavior,
        public readonly bool $is_archived,
        public readonly string $product_id,
        public readonly int $price_amount,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $id = Json::toString(Json::get($data, 'id'));
        $source = ProductPriceSource::from(Json::toString(Json::get($data, 'source')));
        $amount_type = Json::toString(Json::get($data, 'amount_type'));
        $price_currency = Json::toString(Json::get($data, 'price_currency'));
        /** @var TaxBehaviorOption|null $tax_behavior */
        $tax_behavior = (Json::get($data, 'tax_behavior') === null ? null : TaxBehaviorOption::from(Json::toString(Json::get($data, 'tax_behavior'))));
        $is_archived = Json::toBool(Json::get($data, 'is_archived'));
        $product_id = Json::toString(Json::get($data, 'product_id'));
        $price_amount = Json::toInt(Json::get($data, 'price_amount'));

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            source: $source,
            amount_type: $amount_type,
            price_currency: $price_currency,
            tax_behavior: $tax_behavior,
            is_archived: $is_archived,
            product_id: $product_id,
            price_amount: $price_amount,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['id'] = Json::encode($this->id);
        $data['source'] = Json::encode($this->source);
        $data['amount_type'] = Json::encode($this->amount_type);
        $data['price_currency'] = Json::encode($this->price_currency);
        $data['tax_behavior'] = Json::encode($this->tax_behavior);
        $data['is_archived'] = Json::encode($this->is_archived);
        $data['product_id'] = Json::encode($this->product_id);
        $data['price_amount'] = Json::encode($this->price_amount);

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