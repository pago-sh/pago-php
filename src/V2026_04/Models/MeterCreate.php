<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * MeterCreate
 */
final class MeterCreate implements Model, Deserializable
{
    public function __construct(
        public readonly string $name,
        public readonly Filter $filter,
        public readonly CountAggregation|PropertyAggregation|UniqueAggregation $aggregation,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
        /**
         * @var MeterUnit|null
         */
        public readonly ?MeterUnit $unit = null,
        /**
         * @var string|null
         */
        public readonly ?string $custom_label = null,
        /**
         * @var int|null
         */
        public readonly ?int $custom_multiplier = null,
        /**
         * @var string|null
         */
        public readonly ?string $organization_id = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $name = Json::toString(Json::get($data, 'name'));
        $filter = Filter::fromArray(Json::toMap(Json::get($data, 'filter')));
        /** @var CountAggregation|PropertyAggregation|UniqueAggregation $aggregation */
        $aggregation = Union::resolve(Json::get($data, 'aggregation'), 'func', ['avg' => PropertyAggregation::class, 'count' => CountAggregation::class, 'max' => PropertyAggregation::class, 'min' => PropertyAggregation::class, 'sum' => PropertyAggregation::class, 'unique' => UniqueAggregation::class], [CountAggregation::class, PropertyAggregation::class, UniqueAggregation::class]);
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var MeterUnit|null $unit */
        $unit = isset($data['unit']) ? MeterUnit::from(Json::toString($data['unit'])) : null;
        /** @var string|null $custom_label */
        $custom_label = isset($data['custom_label']) ? Json::toString($data['custom_label']) : null;
        /** @var int|null $custom_multiplier */
        $custom_multiplier = isset($data['custom_multiplier']) ? Json::toInt($data['custom_multiplier']) : null;
        /** @var string|null $organization_id */
        $organization_id = isset($data['organization_id']) ? Json::toString($data['organization_id']) : null;

        return new self(
            name: $name,
            filter: $filter,
            aggregation: $aggregation,
            metadata: $metadata,
            unit: $unit,
            custom_label: $custom_label,
            custom_multiplier: $custom_multiplier,
            organization_id: $organization_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = Json::encode($this->name);
        $data['filter'] = Json::encode($this->filter);
        $data['aggregation'] = Json::encode($this->aggregation);
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->unit !== null) {
            $data['unit'] = Json::encode($this->unit);
        }
        if ($this->custom_label !== null) {
            $data['custom_label'] = Json::encode($this->custom_label);
        }
        if ($this->custom_multiplier !== null) {
            $data['custom_multiplier'] = Json::encode($this->custom_multiplier);
        }
        if ($this->organization_id !== null) {
            $data['organization_id'] = Json::encode($this->organization_id);
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