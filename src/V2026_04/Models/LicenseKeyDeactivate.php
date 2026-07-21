<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * LicenseKeyDeactivate
 */
final class LicenseKeyDeactivate implements Model, Deserializable
{
    public function __construct(
        public readonly string $key,
        public readonly string $organization_id,
        public readonly string $activation_id,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $key = Json::toString(Json::get($data, 'key'));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        $activation_id = Json::toString(Json::get($data, 'activation_id'));

        return new self(
            key: $key,
            organization_id: $organization_id,
            activation_id: $activation_id,
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
        $data['activation_id'] = Json::encode($this->activation_id);

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