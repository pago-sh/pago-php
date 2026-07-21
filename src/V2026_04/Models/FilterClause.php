<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * FilterClause
 */
final class FilterClause implements Model, Deserializable
{
    public function __construct(
        public readonly string $property,
        public readonly FilterOperator $operator,
        public readonly string|int|bool $value,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $property = Json::toString(Json::get($data, 'property'));
        $operator = FilterOperator::from(Json::toString(Json::get($data, 'operator')));
        /** @var string|int|bool $value */
        $value = Json::get($data, 'value');

        return new self(
            property: $property,
            operator: $operator,
            value: $value,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['property'] = Json::encode($this->property);
        $data['operator'] = Json::encode($this->operator);
        $data['value'] = Json::encode($this->value);

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