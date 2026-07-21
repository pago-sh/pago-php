<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Information about a metric.
 */
final class Metric implements Model, Deserializable
{
    public function __construct(
        public readonly string $slug,
        public readonly string $display_name,
        public readonly MetricType $type,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $slug = Json::toString(Json::get($data, 'slug'));
        $display_name = Json::toString(Json::get($data, 'display_name'));
        $type = MetricType::from(Json::toString(Json::get($data, 'type')));

        return new self(
            slug: $slug,
            display_name: $display_name,
            type: $type,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['slug'] = Json::encode($this->slug);
        $data['display_name'] = Json::encode($this->display_name);
        $data['type'] = Json::encode($this->type);

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