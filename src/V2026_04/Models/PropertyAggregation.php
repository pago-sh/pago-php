<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * PropertyAggregation
 */
final class PropertyAggregation implements Model, Deserializable
{
    public function __construct(
        public readonly Func $func,
        public readonly string $property,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $func = Func::from(Json::toString(Json::get($data, 'func')));
        $property = Json::toString(Json::get($data, 'property'));

        return new self(
            func: $func,
            property: $property,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['func'] = Json::encode($this->func);
        $data['property'] = Json::encode($this->property);

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