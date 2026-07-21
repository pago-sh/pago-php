<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitDownloadablesCreate
 */
final class BenefitDownloadablesCreate implements Model, Deserializable, BenefitCreate
{
    public function __construct(
        public readonly string $type,
        public readonly string $description,
        public readonly BenefitDownloadablesCreateProperties $properties,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
        /**
         * @var string|null
         */
        public readonly ?string $organization_id = null,
        /**
         * @var BenefitVisibility|null
         */
        public readonly ?BenefitVisibility $visibility = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $type = Json::toString(Json::get($data, 'type'));
        $description = Json::toString(Json::get($data, 'description'));
        $properties = BenefitDownloadablesCreateProperties::fromArray(Json::toMap(Json::get($data, 'properties')));
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var string|null $organization_id */
        $organization_id = isset($data['organization_id']) ? Json::toString($data['organization_id']) : null;
        /** @var BenefitVisibility|null $visibility */
        $visibility = isset($data['visibility']) ? BenefitVisibility::from(Json::toString($data['visibility'])) : null;

        return new self(
            type: $type,
            description: $description,
            properties: $properties,
            metadata: $metadata,
            organization_id: $organization_id,
            visibility: $visibility,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['type'] = Json::encode($this->type);
        $data['description'] = Json::encode($this->description);
        $data['properties'] = Json::encode($this->properties);
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->organization_id !== null) {
            $data['organization_id'] = Json::encode($this->organization_id);
        }
        if ($this->visibility !== null) {
            $data['visibility'] = Json::encode($this->visibility);
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