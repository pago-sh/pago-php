<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * A benefit of type `discord`.
 *
 * Use it to automatically invite your backers to a Discord server.
 */
final class BenefitDiscord implements Model, Deserializable, Benefit
{
    public function __construct(
        public readonly string $id,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $type,
        public readonly string $description,
        public readonly bool $selectable,
        public readonly bool $deletable,
        public readonly bool $is_deleted,
        public readonly string $organization_id,
        /**
         * @var array<string, string|int|float|bool>
         */
        public readonly array $metadata,
        public readonly BenefitVisibility $visibility,
        public readonly BenefitDiscordProperties $properties,
        public readonly bool $visibility_configurable,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $id = Json::toString(Json::get($data, 'id'));
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $type = Json::toString(Json::get($data, 'type'));
        $description = Json::toString(Json::get($data, 'description'));
        $selectable = Json::toBool(Json::get($data, 'selectable'));
        $deletable = Json::toBool(Json::get($data, 'deletable'));
        $is_deleted = Json::toBool(Json::get($data, 'is_deleted'));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        /** @var array<string, string|int|float|bool> $metadata */
        $metadata = Json::toMap(Json::get($data, 'metadata'));
        $visibility = BenefitVisibility::from(Json::toString(Json::get($data, 'visibility')));
        $properties = BenefitDiscordProperties::fromArray(Json::toMap(Json::get($data, 'properties')));
        $visibility_configurable = Json::toBool(Json::get($data, 'visibility_configurable'));

        return new self(
            id: $id,
            created_at: $created_at,
            modified_at: $modified_at,
            type: $type,
            description: $description,
            selectable: $selectable,
            deletable: $deletable,
            is_deleted: $is_deleted,
            organization_id: $organization_id,
            metadata: $metadata,
            visibility: $visibility,
            properties: $properties,
            visibility_configurable: $visibility_configurable,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = Json::encode($this->id);
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['type'] = Json::encode($this->type);
        $data['description'] = Json::encode($this->description);
        $data['selectable'] = Json::encode($this->selectable);
        $data['deletable'] = Json::encode($this->deletable);
        $data['is_deleted'] = Json::encode($this->is_deleted);
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['metadata'] = Json::encode($this->metadata);
        $data['visibility'] = Json::encode($this->visibility);
        $data['properties'] = Json::encode($this->properties);
        $data['visibility_configurable'] = Json::encode($this->visibility_configurable);

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