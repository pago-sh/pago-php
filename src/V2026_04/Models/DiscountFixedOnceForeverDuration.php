<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema for a fixed amount discount that is applied once or forever.
 */
final class DiscountFixedOnceForeverDuration implements Model, Deserializable, Discount
{
    public function __construct(
        public readonly DiscountDuration $duration,
        public readonly DiscountType $type,
        /**
         * @deprecated
         */
        public readonly int $amount,
        /**
         * @deprecated
         */
        public readonly string $currency,
        /**
         * @var array<string, int>
         */
        public readonly array $amounts,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        /**
         * @var array<string, string|int|float|bool>
         */
        public readonly array $metadata,
        public readonly string $name,
        /**
         * @var string|null
         */
        public readonly ?string $code,
        /**
         * @var string|null
         */
        public readonly ?string $starts_at,
        /**
         * @var string|null
         */
        public readonly ?string $ends_at,
        /**
         * @var int|null
         */
        public readonly ?int $max_redemptions,
        public readonly int $redemptions_count,
        public readonly string $organization_id,
        /**
         * @var list<DiscountProduct>
         */
        public readonly array $products,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $duration = DiscountDuration::from(Json::toString(Json::get($data, 'duration')));
        $type = DiscountType::from(Json::toString(Json::get($data, 'type')));
        $amount = Json::toInt(Json::get($data, 'amount'));
        $currency = Json::toString(Json::get($data, 'currency'));
        /** @var array<string, int> $amounts */
        $amounts = array_map(static fn (mixed $item0): int => Json::toInt($item0), Json::toMap(Json::get($data, 'amounts')));
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $id = Json::toString(Json::get($data, 'id'));
        /** @var array<string, string|int|float|bool> $metadata */
        $metadata = Json::toMap(Json::get($data, 'metadata'));
        $name = Json::toString(Json::get($data, 'name'));
        /** @var string|null $code */
        $code = (Json::get($data, 'code') === null ? null : Json::toString(Json::get($data, 'code')));
        /** @var string|null $starts_at */
        $starts_at = (Json::get($data, 'starts_at') === null ? null : Json::toString(Json::get($data, 'starts_at')));
        /** @var string|null $ends_at */
        $ends_at = (Json::get($data, 'ends_at') === null ? null : Json::toString(Json::get($data, 'ends_at')));
        /** @var int|null $max_redemptions */
        $max_redemptions = (Json::get($data, 'max_redemptions') === null ? null : Json::toInt(Json::get($data, 'max_redemptions')));
        $redemptions_count = Json::toInt(Json::get($data, 'redemptions_count'));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        /** @var list<DiscountProduct> $products */
        $products = array_map(static fn (mixed $item0): DiscountProduct => DiscountProduct::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'products')));

        return new self(
            duration: $duration,
            type: $type,
            amount: $amount,
            currency: $currency,
            amounts: $amounts,
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            metadata: $metadata,
            name: $name,
            code: $code,
            starts_at: $starts_at,
            ends_at: $ends_at,
            max_redemptions: $max_redemptions,
            redemptions_count: $redemptions_count,
            organization_id: $organization_id,
            products: $products,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['duration'] = Json::encode($this->duration);
        $data['type'] = Json::encode($this->type);
        $data['amount'] = Json::encode($this->amount);
        $data['currency'] = Json::encode($this->currency);
        $data['amounts'] = Json::encode($this->amounts);
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['id'] = Json::encode($this->id);
        $data['metadata'] = Json::encode($this->metadata);
        $data['name'] = Json::encode($this->name);
        $data['code'] = Json::encode($this->code);
        $data['starts_at'] = Json::encode($this->starts_at);
        $data['ends_at'] = Json::encode($this->ends_at);
        $data['max_redemptions'] = Json::encode($this->max_redemptions);
        $data['redemptions_count'] = Json::encode($this->redemptions_count);
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['products'] = Json::encode($this->products);

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