<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitGitHubRepositorySubscriber
 */
final class BenefitGitHubRepositorySubscriber implements Model, Deserializable
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
        public readonly BenefitSubscriberOrganization $organization,
        public readonly BenefitGitHubRepositorySubscriberProperties $properties,
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
        $organization = BenefitSubscriberOrganization::fromArray(Json::toMap(Json::get($data, 'organization')));
        $properties = BenefitGitHubRepositorySubscriberProperties::fromArray(Json::toMap(Json::get($data, 'properties')));

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
            organization: $organization,
            properties: $properties,
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
        $data['organization'] = Json::encode($this->organization);
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