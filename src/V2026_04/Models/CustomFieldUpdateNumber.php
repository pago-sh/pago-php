<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to update a custom field of type number.
 */
final class CustomFieldUpdateNumber implements Model, Deserializable, CustomFieldUpdate
{
    public function __construct(
        public readonly string $type,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
        /**
         * @var string|null
         */
        public readonly ?string $slug = null,
        /**
         * @var CustomFieldNumberProperties|null
         */
        public readonly ?CustomFieldNumberProperties $properties = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $type = Json::toString(Json::get($data, 'type'));
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;
        /** @var string|null $slug */
        $slug = isset($data['slug']) ? Json::toString($data['slug']) : null;
        /** @var CustomFieldNumberProperties|null $properties */
        $properties = isset($data['properties']) ? CustomFieldNumberProperties::fromArray(Json::toMap($data['properties'])) : null;

        return new self(
            type: $type,
            metadata: $metadata,
            name: $name,
            slug: $slug,
            properties: $properties,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['type'] = Json::encode($this->type);
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->name !== null) {
            $data['name'] = Json::encode($this->name);
        }
        if ($this->slug !== null) {
            $data['slug'] = Json::encode($this->slug);
        }
        if ($this->properties !== null) {
            $data['properties'] = Json::encode($this->properties);
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