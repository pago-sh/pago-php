<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to create a percentage discount.
 */
final class DiscountPercentageCreate implements Model, Deserializable, DiscountCreate
{
    public function __construct(
        public readonly string $name,
        public readonly DiscountDuration $duration,
        public readonly int $basis_points,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
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
         * @var list<string>|null
         */
        public readonly ?array $products = null,
        /**
         * @var string|null
         */
        public readonly ?string $organization_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $type = null,
        /**
         * @var int|null
         */
        public readonly ?int $duration_in_months = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $name = Json::toString(Json::get($data, 'name'));
        $duration = DiscountDuration::from(Json::toString(Json::get($data, 'duration')));
        $basis_points = Json::toInt(Json::get($data, 'basis_points'));
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var string|null $code */
        $code = isset($data['code']) ? Json::toString($data['code']) : null;
        /** @var string|null $starts_at */
        $starts_at = isset($data['starts_at']) ? Json::toString($data['starts_at']) : null;
        /** @var string|null $ends_at */
        $ends_at = isset($data['ends_at']) ? Json::toString($data['ends_at']) : null;
        /** @var int|null $max_redemptions */
        $max_redemptions = isset($data['max_redemptions']) ? Json::toInt($data['max_redemptions']) : null;
        /** @var list<string>|null $products */
        $products = isset($data['products']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList($data['products'])) : null;
        /** @var string|null $organization_id */
        $organization_id = isset($data['organization_id']) ? Json::toString($data['organization_id']) : null;
        /** @var string|null $type */
        $type = isset($data['type']) ? Json::toString($data['type']) : null;
        /** @var int|null $duration_in_months */
        $duration_in_months = isset($data['duration_in_months']) ? Json::toInt($data['duration_in_months']) : null;

        return new self(
            name: $name,
            duration: $duration,
            basis_points: $basis_points,
            metadata: $metadata,
            code: $code,
            starts_at: $starts_at,
            ends_at: $ends_at,
            max_redemptions: $max_redemptions,
            products: $products,
            organization_id: $organization_id,
            type: $type,
            duration_in_months: $duration_in_months,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = Json::encode($this->name);
        $data['duration'] = Json::encode($this->duration);
        $data['basis_points'] = Json::encode($this->basis_points);
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
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
        if ($this->products !== null) {
            $data['products'] = Json::encode($this->products);
        }
        if ($this->organization_id !== null) {
            $data['organization_id'] = Json::encode($this->organization_id);
        }
        if ($this->type !== null) {
            $data['type'] = Json::encode($this->type);
        }
        if ($this->duration_in_months !== null) {
            $data['duration_in_months'] = Json::encode($this->duration_in_months);
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