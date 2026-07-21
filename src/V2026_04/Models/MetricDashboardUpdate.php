<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema for updating a metrics dashboard.
 */
final class MetricDashboardUpdate implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
        /**
         * @var list<string>|null
         */
        public readonly ?array $metrics = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;
        /** @var list<string>|null $metrics */
        $metrics = isset($data['metrics']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList($data['metrics'])) : null;

        return new self(
            name: $name,
            metrics: $metrics,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->name !== null) {
            $data['name'] = Json::encode($this->name);
        }
        if ($this->metrics !== null) {
            $data['metrics'] = Json::encode($this->metrics);
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