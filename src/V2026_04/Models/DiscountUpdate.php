<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to update a discount.
 */
final class DiscountUpdate implements Model, Deserializable
{
    public function __construct(
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
        /**
         * @var string|null
         */
        public readonly ?string $code = null,
        /**
         * @var string|null
         */
        public readonly ?string $starts_at = null,
        /**
         * @var string|null
         */
        public readonly ?string $ends_at = null,
        /**
         * @var int|null
         */
        public readonly ?int $max_redemptions = null,
        /**
         * @var DiscountDuration|null
         */
        public readonly ?DiscountDuration $duration = null,
        /**
         * @var int|null
         */
        public readonly ?int $duration_in_months = null,
        /**
         * @var DiscountType|null
         */
        public readonly ?DiscountType $type = null,
        /**
         * @deprecated
         * @var int|null
         */
        public readonly ?int $amount = null,
        /**
         * @deprecated
         * @var PresentmentCurrency|null
         */
        public readonly ?PresentmentCurrency $currency = null,
        /**
         * @var array<string, int>|null
         */
        public readonly ?array $amounts = null,
        /**
         * @var int|null
         */
        public readonly ?int $basis_points = null,
        /**
         * @var list<string>|null
         */
        public readonly ?array $products = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;
        /** @var string|null $code */
        $code = isset($data['code']) ? Json::toString($data['code']) : null;
        /** @var string|null $starts_at */
        $starts_at = isset($data['starts_at']) ? Json::toString($data['starts_at']) : null;
        /** @var string|null $ends_at */
        $ends_at = isset($data['ends_at']) ? Json::toString($data['ends_at']) : null;
        /** @var int|null $max_redemptions */
        $max_redemptions = isset($data['max_redemptions']) ? Json::toInt($data['max_redemptions']) : null;
        /** @var DiscountDuration|null $duration */
        $duration = isset($data['duration']) ? DiscountDuration::from(Json::toString($data['duration'])) : null;
        /** @var int|null $duration_in_months */
        $duration_in_months = isset($data['duration_in_months']) ? Json::toInt($data['duration_in_months']) : null;
        /** @var DiscountType|null $type */
        $type = isset($data['type']) ? DiscountType::from(Json::toString($data['type'])) : null;
        /** @var int|null $amount */
        $amount = isset($data['amount']) ? Json::toInt($data['amount']) : null;
        /** @var PresentmentCurrency|null $currency */
        $currency = isset($data['currency']) ? PresentmentCurrency::from(Json::toString($data['currency'])) : null;
        /** @var array<string, int>|null $amounts */
        $amounts = isset($data['amounts']) ? array_map(static fn (mixed $item0): int => Json::toInt($item0), Json::toMap($data['amounts'])) : null;
        /** @var int|null $basis_points */
        $basis_points = isset($data['basis_points']) ? Json::toInt($data['basis_points']) : null;
        /** @var list<string>|null $products */
        $products = isset($data['products']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList($data['products'])) : null;

        return new self(
            metadata: $metadata,
            name: $name,
            code: $code,
            starts_at: $starts_at,
            ends_at: $ends_at,
            max_redemptions: $max_redemptions,
            duration: $duration,
            duration_in_months: $duration_in_months,
            type: $type,
            amount: $amount,
            currency: $currency,
            amounts: $amounts,
            basis_points: $basis_points,
            products: $products,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->name !== null) {
            $data['name'] = Json::encode($this->name);
        }
        if ($this->code !== null) {
            $data['code'] = Json::encode($this->code);
        }
        if ($this->starts_at !== null) {
            $data['starts_at'] = Json::encode($this->starts_at);
        }
        if ($this->ends_at !== null) {
            $data['ends_at'] = Json::encode($this->ends_at);
        }
        if ($this->max_redemptions !== null) {
            $data['max_redemptions'] = Json::encode($this->max_redemptions);
        }
        if ($this->duration !== null) {
            $data['duration'] = Json::encode($this->duration);
        }
        if ($this->duration_in_months !== null) {
            $data['duration_in_months'] = Json::encode($this->duration_in_months);
        }
        if ($this->type !== null) {
            $data['type'] = Json::encode($this->type);
        }
        if ($this->amount !== null) {
            $data['amount'] = Json::encode($this->amount);
        }
        if ($this->currency !== null) {
            $data['currency'] = Json::encode($this->currency);
        }
        if ($this->amounts !== null) {
            $data['amounts'] = Json::encode($this->amounts);
        }
        if ($this->basis_points !== null) {
            $data['basis_points'] = Json::encode($this->basis_points);
        }
        if ($this->products !== null) {
            $data['products'] = Json::encode($this->products);
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