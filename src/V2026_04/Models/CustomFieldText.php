<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema for a custom field of type text.
 */
final class CustomFieldText implements Model, Deserializable, CustomField
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        /**
         * @var array<string, string|int|float|bool>
         */
        public readonly array $metadata,
        public readonly string $type,
        public readonly string $slug,
        public readonly string $name,
        public readonly string $organization_id,
        public readonly CustomFieldTextProperties $properties,
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
        /** @var array<string, string|int|float|bool> $metadata */
        $metadata = Json::toMap(Json::get($data, 'metadata'));
        $type = Json::toString(Json::get($data, 'type'));
        $slug = Json::toString(Json::get($data, 'slug'));
        $name = Json::toString(Json::get($data, 'name'));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        $properties = CustomFieldTextProperties::fromArray(Json::toMap(Json::get($data, 'properties')));

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            metadata: $metadata,
            type: $type,
            slug: $slug,
            name: $name,
            organization_id: $organization_id,
            properties: $properties,
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
        $data['metadata'] = Json::encode($this->metadata);
        $data['type'] = Json::encode($this->type);
        $data['slug'] = Json::encode($this->slug);
        $data['name'] = Json::encode($this->name);
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['properties'] = Json::encode($this->properties);

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