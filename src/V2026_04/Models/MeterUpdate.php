<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * MeterUpdate
 */
final class MeterUpdate implements Model, Deserializable
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
         * @var Filter|null
         */
        public readonly ?Filter $filter = null,
        public readonly CountAggregation|PropertyAggregation|UniqueAggregation|null $aggregation = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $is_archived = null,
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
        /** @var MeterUnit|null $unit */
        $unit = isset($data['unit']) ? MeterUnit::from(Json::toString($data['unit'])) : null;
        /** @var string|null $custom_label */
        $custom_label = isset($data['custom_label']) ? Json::toString($data['custom_label']) : null;
        /** @var int|null $custom_multiplier */
        $custom_multiplier = isset($data['custom_multiplier']) ? Json::toInt($data['custom_multiplier']) : null;
        /** @var Filter|null $filter */
        $filter = isset($data['filter']) ? Filter::fromArray(Json::toMap($data['filter'])) : null;
        /** @var CountAggregation|PropertyAggregation|UniqueAggregation|null $aggregation */
        $aggregation = isset($data['aggregation']) ? Union::resolve($data['aggregation'], 'func', ['avg' => PropertyAggregation::class, 'count' => CountAggregation::class, 'max' => PropertyAggregation::class, 'min' => PropertyAggregation::class, 'sum' => PropertyAggregation::class, 'unique' => UniqueAggregation::class], [CountAggregation::class, PropertyAggregation::class, UniqueAggregation::class]) : null;
        /** @var bool|null $is_archived */
        $is_archived = isset($data['is_archived']) ? Json::toBool($data['is_archived']) : null;

        return new self(
            metadata: $metadata,
            name: $name,
            unit: $unit,
            custom_label: $custom_label,
            custom_multiplier: $custom_multiplier,
            filter: $filter,
            aggregation: $aggregation,
            is_archived: $is_archived,
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
        if ($this->unit !== null) {
            $data['unit'] = Json::encode($this->unit);
        }
        if ($this->custom_label !== null) {
            $data['custom_label'] = Json::encode($this->custom_label);
        }
        if ($this->custom_multiplier !== null) {
            $data['custom_multiplier'] = Json::encode($this->custom_multiplier);
        }
        if ($this->filter !== null) {
            $data['filter'] = Json::encode($this->filter);
        }
        if ($this->aggregation !== null) {
            $data['aggregation'] = Json::encode($this->aggregation);
        }
        if ($this->is_archived !== null) {
            $data['is_archived'] = Json::encode($this->is_archived);
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