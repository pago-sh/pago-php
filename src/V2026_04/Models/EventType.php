<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * EventType
 */
final class EventType implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly string $name,
        public readonly string $label,
        public readonly string $organization_id,
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
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $id = Json::toString(Json::get($data, 'id'));
        $name = Json::toString(Json::get($data, 'name'));
        $label = Json::toString(Json::get($data, 'label'));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        /** @var string|null $label_property_selector */
        $label_property_selector = isset($data['label_property_selector']) ? Json::toString($data['label_property_selector']) : null;

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            name: $name,
            label: $label,
            organization_id: $organization_id,
            label_property_selector: $label_property_selector,
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
        $data['label'] = Json::encode($this->label);
        $data['organization_id'] = Json::encode($this->organization_id);
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