<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * UniqueAggregation
 */
final class UniqueAggregation implements Model, Deserializable
{
    public function __construct(
        public readonly string $property,
        /**
         * @var string|null
         */
        public readonly ?string $func = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $property = Json::toString(Json::get($data, 'property'));
        /** @var string|null $func */
        $func = isset($data['func']) ? Json::toString($data['func']) : null;

        return new self(
            property: $property,
            func: $func,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['property'] = Json::encode($this->property);
        if ($this->func !== null) {
            $data['func'] = Json::encode($this->func);
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