<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema for creating a metrics dashboard.
 */
final class MetricDashboardCreate implements Model, Deserializable
{
    public function __construct(
        public readonly string $name,
        /**
         * @var list<string>|null
         */
        public readonly ?array $metrics = null,
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
        /** @var list<string>|null $metrics */
        $metrics = isset($data['metrics']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList($data['metrics'])) : null;
        /** @var string|null $organization_id */
        $organization_id = isset($data['organization_id']) ? Json::toString($data['organization_id']) : null;

        return new self(
            name: $name,
            metrics: $metrics,
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
        if ($this->metrics !== null) {
            $data['metrics'] = Json::encode($this->metrics);
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