<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to create a custom field of type checkbox.
 */
final class CustomFieldCreateCheckbox implements Model, Deserializable, CustomFieldCreate
{
    public function __construct(
        public readonly string $type,
        public readonly string $slug,
        public readonly string $name,
        public readonly CustomFieldCheckboxProperties $properties,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
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
        $type = Json::toString(Json::get($data, 'type'));
        $slug = Json::toString(Json::get($data, 'slug'));
        $name = Json::toString(Json::get($data, 'name'));
        $properties = CustomFieldCheckboxProperties::fromArray(Json::toMap(Json::get($data, 'properties')));
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var string|null $organization_id */
        $organization_id = isset($data['organization_id']) ? Json::toString($data['organization_id']) : null;

        return new self(
            type: $type,
            slug: $slug,
            name: $name,
            properties: $properties,
            metadata: $metadata,
            organization_id: $organization_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['type'] = Json::encode($this->type);
        $data['slug'] = Json::encode($this->slug);
        $data['name'] = Json::encode($this->name);
        $data['properties'] = Json::encode($this->properties);
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
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