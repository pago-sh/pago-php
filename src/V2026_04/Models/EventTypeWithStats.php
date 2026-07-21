<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * EventTypeWithStats
 */
final class EventTypeWithStats implements Model, Deserializable
{
    public function __construct(
        public readonly string $name,
        public readonly string $label,
        public readonly string $organization_id,
        public readonly EventSource $source,
        public readonly int $occurrences,
        public readonly string $first_seen,
        public readonly string $last_seen,
        /**
         * @var string|null
         */
        public readonly ?string $id = null,
        /**
         * @var string|null
         */
        public readonly ?string $created_at = null,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at = null,
        /**
         * @var string|null
         */
        public readonly ?string $label_property_selector = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $name = Json::toString(Json::get($data, 'name'));
        $label = Json::toString(Json::get($data, 'label'));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        $source = EventSource::from(Json::toString(Json::get($data, 'source')));
        $occurrences = Json::toInt(Json::get($data, 'occurrences'));
        $first_seen = Json::toString(Json::get($data, 'first_seen'));
        $last_seen = Json::toString(Json::get($data, 'last_seen'));
        /** @var string|null $id */
        $id = isset($data['id']) ? Json::toString($data['id']) : null;
        /** @var string|null $created_at */
        $created_at = isset($data['created_at']) ? Json::toString($data['created_at']) : null;
        /** @var string|null $modified_at */
        $modified_at = isset($data['modified_at']) ? Json::toString($data['modified_at']) : null;
        /** @var string|null $label_property_selector */
        $label_property_selector = isset($data['label_property_selector']) ? Json::toString($data['label_property_selector']) : null;

        return new self(
            name: $name,
            label: $label,
            organization_id: $organization_id,
            source: $source,
            occurrences: $occurrences,
            first_seen: $first_seen,
            last_seen: $last_seen,
            id: $id,
            created_at: $created_at,
            modified_at: $modified_at,
            label_property_selector: $label_property_selector,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = Json::encode($this->name);
        $data['label'] = Json::encode($this->label);
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['source'] = Json::encode($this->source);
        $data['occurrences'] = Json::encode($this->occurrences);
        $data['first_seen'] = Json::encode($this->first_seen);
        $data['last_seen'] = Json::encode($this->last_seen);
        if ($this->id !== null) {
            $data['id'] = Json::encode($this->id);
        }
        if ($this->created_at !== null) {
            $data['created_at'] = Json::encode($this->created_at);
        }
        if ($this->modified_at !== null) {
            $data['modified_at'] = Json::encode($this->modified_at);
        }
        if ($this->label_property_selector !== null) {
            $data['label_property_selector'] = Json::encode($this->label_property_selector);
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