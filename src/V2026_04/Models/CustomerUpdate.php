<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerUpdate
 */
final class CustomerUpdate implements Model, Deserializable
{
    public function __construct(
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
        /**
         * @var string|null
         */
        public readonly ?string $email = null,
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
        /**
         * @var AddressInput|null
         */
        public readonly ?AddressInput $billing_address = null,
        /**
         * @var string|null
         */
        public readonly ?string $tax_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $locale = null,
        /**
         * @var string|null
         */
        public readonly ?string $external_id = null,
        /**
         * @var CustomerType|null
         */
        public readonly ?CustomerType $type = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var string|null $email */
        $email = isset($data['email']) ? Json::toString($data['email']) : null;
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;
        /** @var AddressInput|null $billing_address */
        $billing_address = isset($data['billing_address']) ? AddressInput::fromArray(Json::toMap($data['billing_address'])) : null;
        /** @var string|null $tax_id */
        $tax_id = isset($data['tax_id']) ? Json::toString($data['tax_id']) : null;
        /** @var string|null $locale */
        $locale = isset($data['locale']) ? Json::toString($data['locale']) : null;
        /** @var string|null $external_id */
        $external_id = isset($data['external_id']) ? Json::toString($data['external_id']) : null;
        /** @var CustomerType|null $type */
        $type = isset($data['type']) ? CustomerType::from(Json::toString($data['type'])) : null;

        return new self(
            metadata: $metadata,
            email: $email,
            name: $name,
            billing_address: $billing_address,
            tax_id: $tax_id,
            locale: $locale,
            external_id: $external_id,
            type: $type,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->email !== null) {
            $data['email'] = Json::encode($this->email);
        }
        if ($this->name !== null) {
            $data['name'] = Json::encode($this->name);
        }
        if ($this->billing_address !== null) {
            $data['billing_address'] = Json::encode($this->billing_address);
        }
        if ($this->tax_id !== null) {
            $data['tax_id'] = Json::encode($this->tax_id);
        }
        if ($this->locale !== null) {
            $data['locale'] = Json::encode($this->locale);
        }
        if ($this->external_id !== null) {
            $data['external_id'] = Json::encode($this->external_id);
        }
        if ($this->type !== null) {
            $data['type'] = Json::encode($this->type);
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