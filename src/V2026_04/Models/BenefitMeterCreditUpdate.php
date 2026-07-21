<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * BenefitMeterCreditUpdate
 */
final class BenefitMeterCreditUpdate implements Model, Deserializable
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
        public readonly ?string $description = null,
        /**
         * @var BenefitVisibility|null
         */
        public readonly ?BenefitVisibility $visibility = null,
        /**
         * @var BenefitMeterCreditCreateProperties|null
         */
        public readonly ?BenefitMeterCreditCreateProperties $properties = null,
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
        /** @var string|null $description */
        $description = isset($data['description']) ? Json::toString($data['description']) : null;
        /** @var BenefitVisibility|null $visibility */
        $visibility = isset($data['visibility']) ? BenefitVisibility::from(Json::toString($data['visibility'])) : null;
        /** @var BenefitMeterCreditCreateProperties|null $properties */
        $properties = isset($data['properties']) ? BenefitMeterCreditCreateProperties::fromArray(Json::toMap($data['properties'])) : null;

        return new self(
            type: $type,
            metadata: $metadata,
            description: $description,
            visibility: $visibility,
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
        if ($this->description !== null) {
            $data['description'] = Json::encode($this->description);
        }
        if ($this->visibility !== null) {
            $data['visibility'] = Json::encode($this->visibility);
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