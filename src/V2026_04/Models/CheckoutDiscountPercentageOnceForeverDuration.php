<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema for a percentage discount that is applied once or forever.
 */
final class CheckoutDiscountPercentageOnceForeverDuration implements Model, Deserializable
{
    public function __construct(
        public readonly DiscountDuration $duration,
        public readonly DiscountType $type,
        public readonly int $basis_points,
        public readonly string $id,
        public readonly string $name,
        /**
         * @var string|null
         */
        public readonly ?string $code,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $duration = DiscountDuration::from(Json::toString(Json::get($data, 'duration')));
        $type = DiscountType::from(Json::toString(Json::get($data, 'type')));
        $basis_points = Json::toInt(Json::get($data, 'basis_points'));
        $id = Json::toString(Json::get($data, 'id'));
        $name = Json::toString(Json::get($data, 'name'));
        /** @var string|null $code */
        $code = (Json::get($data, 'code') === null ? null : Json::toString(Json::get($data, 'code')));

        return new self(
            duration: $duration,
            type: $type,
            basis_points: $basis_points,
            id: $id,
            name: $name,
            code: $code,
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
        $data['basis_points'] = Json::encode($this->basis_points);
        $data['id'] = Json::encode($this->id);
        $data['name'] = Json::encode($this->name);
        $data['code'] = Json::encode($this->code);

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