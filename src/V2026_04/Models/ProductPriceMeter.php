<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * A meter associated to a metered price.
 */
final class ProductPriceMeter implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly MeterUnit $unit,
        /**
         * @var string|null
         */
        public readonly ?string $custom_label,
        /**
         * @var int|null
         */
        public readonly ?int $custom_multiplier,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $id = Json::toString(Json::get($data, 'id'));
        $name = Json::toString(Json::get($data, 'name'));
        $unit = MeterUnit::from(Json::toString(Json::get($data, 'unit')));
        /** @var string|null $custom_label */
        $custom_label = (Json::get($data, 'custom_label') === null ? null : Json::toString(Json::get($data, 'custom_label')));
        /** @var int|null $custom_multiplier */
        $custom_multiplier = (Json::get($data, 'custom_multiplier') === null ? null : Json::toInt(Json::get($data, 'custom_multiplier')));

        return new self(
            id: $id,
            name: $name,
            unit: $unit,
            custom_label: $custom_label,
            custom_multiplier: $custom_multiplier,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = Json::encode($this->id);
        $data['name'] = Json::encode($this->name);
        $data['unit'] = Json::encode($this->unit);
        $data['custom_label'] = Json::encode($this->custom_label);
        $data['custom_multiplier'] = Json::encode($this->custom_multiplier);

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