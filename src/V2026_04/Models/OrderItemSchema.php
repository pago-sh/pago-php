<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * An order line item.
 */
final class OrderItemSchema implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly string $label,
        public readonly int $amount,
        public readonly int $tax_amount,
        public readonly bool $proration,
        /**
         * @var string|null
         */
        public readonly ?string $product_price_id,
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
        $label = Json::toString(Json::get($data, 'label'));
        $amount = Json::toInt(Json::get($data, 'amount'));
        $tax_amount = Json::toInt(Json::get($data, 'tax_amount'));
        $proration = Json::toBool(Json::get($data, 'proration'));
        /** @var string|null $product_price_id */
        $product_price_id = (Json::get($data, 'product_price_id') === null ? null : Json::toString(Json::get($data, 'product_price_id')));

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            label: $label,
            amount: $amount,
            tax_amount: $tax_amount,
            proration: $proration,
            product_price_id: $product_price_id,
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
        $data['label'] = Json::encode($this->label);
        $data['amount'] = Json::encode($this->amount);
        $data['tax_amount'] = Json::encode($this->tax_amount);
        $data['proration'] = Json::encode($this->proration);
        $data['product_price_id'] = Json::encode($this->product_price_id);

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