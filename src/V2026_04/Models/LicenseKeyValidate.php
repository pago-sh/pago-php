<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * LicenseKeyValidate
 */
final class LicenseKeyValidate implements Model, Deserializable
{
    public function __construct(
        public readonly string $key,
        public readonly string $organization_id,
        /**
         * @var string|null
         */
        public readonly ?string $activation_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $benefit_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $customer_id = null,
        /**
         * @var int|null
         */
        public readonly ?int $increment_usage = null,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $conditions = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $key = Json::toString(Json::get($data, 'key'));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        /** @var string|null $activation_id */
        $activation_id = isset($data['activation_id']) ? Json::toString($data['activation_id']) : null;
        /** @var string|null $benefit_id */
        $benefit_id = isset($data['benefit_id']) ? Json::toString($data['benefit_id']) : null;
        /** @var string|null $customer_id */
        $customer_id = isset($data['customer_id']) ? Json::toString($data['customer_id']) : null;
        /** @var int|null $increment_usage */
        $increment_usage = isset($data['increment_usage']) ? Json::toInt($data['increment_usage']) : null;
        /** @var array<string, string|int|float|bool>|null $conditions */
        $conditions = isset($data['conditions']) ? Json::toMap($data['conditions']) : null;

        return new self(
            key: $key,
            organization_id: $organization_id,
            activation_id: $activation_id,
            benefit_id: $benefit_id,
            customer_id: $customer_id,
            increment_usage: $increment_usage,
            conditions: $conditions,
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
        if ($this->activation_id !== null) {
            $data['activation_id'] = Json::encode($this->activation_id);
        }
        if ($this->benefit_id !== null) {
            $data['benefit_id'] = Json::encode($this->benefit_id);
        }
        if ($this->customer_id !== null) {
            $data['customer_id'] = Json::encode($this->customer_id);
        }
        if ($this->increment_usage !== null) {
            $data['increment_usage'] = Json::encode($this->increment_usage);
        }
        if ($this->conditions !== null) {
            $data['conditions'] = Json::encode($this->conditions);
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