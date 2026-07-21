<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * LicenseKeyActivate
 */
final class LicenseKeyActivate implements Model, Deserializable
{
    public function __construct(
        public readonly string $key,
        public readonly string $organization_id,
        public readonly string $label,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $conditions = null,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $meta = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $key = Json::toString(Json::get($data, 'key'));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        $label = Json::toString(Json::get($data, 'label'));
        /** @var array<string, string|int|float|bool>|null $conditions */
        $conditions = isset($data['conditions']) ? Json::toMap($data['conditions']) : null;
        /** @var array<string, string|int|float|bool>|null $meta */
        $meta = isset($data['meta']) ? Json::toMap($data['meta']) : null;

        return new self(
            key: $key,
            organization_id: $organization_id,
            label: $label,
            conditions: $conditions,
            meta: $meta,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['key'] = Json::encode($this->key);
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['label'] = Json::encode($this->label);
        if ($this->conditions !== null) {
            $data['conditions'] = Json::encode($this->conditions);
        }
        if ($this->meta !== null) {
            $data['meta'] = Json::encode($this->meta);
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