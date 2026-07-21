<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Meter
 */
final class Meter implements Model, Deserializable
{
    public function __construct(
        /**
         * @var array<string, string|int|float|bool>
         */
        public readonly array $metadata,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly string $name,
        public readonly MeterUnit $unit,
        public readonly Filter $filter,
        public readonly CountAggregation|PropertyAggregation|UniqueAggregation $aggregation,
        public readonly string $organization_id,
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
        public readonly ?string $archived_at = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var array<string, string|int|float|bool> $metadata */
        $metadata = Json::toMap(Json::get($data, 'metadata'));
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $id = Json::toString(Json::get($data, 'id'));
        $name = Json::toString(Json::get($data, 'name'));
        $unit = MeterUnit::from(Json::toString(Json::get($data, 'unit')));
        $filter = Filter::fromArray(Json::toMap(Json::get($data, 'filter')));
        /** @var CountAggregation|PropertyAggregation|UniqueAggregation $aggregation */
        $aggregation = Union::resolve(Json::get($data, 'aggregation'), 'func', ['avg' => PropertyAggregation::class, 'count' => CountAggregation::class, 'max' => PropertyAggregation::class, 'min' => PropertyAggregation::class, 'sum' => PropertyAggregation::class, 'unique' => UniqueAggregation::class], [CountAggregation::class, PropertyAggregation::class, UniqueAggregation::class]);
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        /** @var string|null $custom_label */
        $custom_label = isset($data['custom_label']) ? Json::toString($data['custom_label']) : null;
        /** @var int|null $custom_multiplier */
        $custom_multiplier = isset($data['custom_multiplier']) ? Json::toInt($data['custom_multiplier']) : null;
        /** @var string|null $archived_at */
        $archived_at = isset($data['archived_at']) ? Json::toString($data['archived_at']) : null;

        return new self(
            metadata: $metadata,
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            name: $name,
            unit: $unit,
            filter: $filter,
            aggregation: $aggregation,
            organization_id: $organization_id,
            custom_label: $custom_label,
            custom_multiplier: $custom_multiplier,
            archived_at: $archived_at,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['metadata'] = Json::encode($this->metadata);
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['id'] = Json::encode($this->id);
        $data['name'] = Json::encode($this->name);
        $data['unit'] = Json::encode($this->unit);
        $data['filter'] = Json::encode($this->filter);
        $data['aggregation'] = Json::encode($this->aggregation);
        $data['organization_id'] = Json::encode($this->organization_id);
        if ($this->custom_label !== null) {
            $data['custom_label'] = Json::encode($this->custom_label);
        }
        if ($this->custom_multiplier !== null) {
            $data['custom_multiplier'] = Json::encode($this->custom_multiplier);
        }
        if ($this->archived_at !== null) {
            $data['archived_at'] = Json::encode($this->archived_at);
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