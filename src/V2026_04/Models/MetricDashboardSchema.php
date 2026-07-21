<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * A user-defined metrics dashboard.
 */
final class MetricDashboardSchema implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly string $name,
        /**
         * @var list<string>
         */
        public readonly array $metrics,
        public readonly string $organization_id,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $id = Json::toString(Json::get($data, 'id'));
        $name = Json::toString(Json::get($data, 'name'));
        /** @var list<string> $metrics */
        $metrics = array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList(Json::get($data, 'metrics')));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
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
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['id'] = Json::encode($this->id);
        $data['name'] = Json::encode($this->name);
        $data['metrics'] = Json::encode($this->metrics);
        $data['organization_id'] = Json::encode($this->organization_id);

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