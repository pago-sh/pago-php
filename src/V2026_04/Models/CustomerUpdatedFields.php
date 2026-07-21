<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerUpdatedFields
 */
final class CustomerUpdatedFields implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
        /**
         * @var string|null
         */
        public readonly ?string $billing_name = null,
        /**
         * @var string|null
         */
        public readonly ?string $email = null,
        /**
         * @var AddressDict|null
         */
        public readonly ?AddressDict $billing_address = null,
        /**
         * @var string|null
         */
        public readonly ?string $tax_id = null,
        /**
         * @var array<string, string|int|bool>|null
         */
        public readonly ?array $metadata = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;
        /** @var string|null $billing_name */
        $billing_name = isset($data['billing_name']) ? Json::toString($data['billing_name']) : null;
        /** @var string|null $email */
        $email = isset($data['email']) ? Json::toString($data['email']) : null;
        /** @var AddressDict|null $billing_address */
        $billing_address = isset($data['billing_address']) ? AddressDict::fromArray(Json::toMap($data['billing_address'])) : null;
        /** @var string|null $tax_id */
        $tax_id = isset($data['tax_id']) ? Json::toString($data['tax_id']) : null;
        /** @var array<string, string|int|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;

        return new self(
            name: $name,
            billing_name: $billing_name,
            email: $email,
            billing_address: $billing_address,
            tax_id: $tax_id,
            metadata: $metadata,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->name !== null) {
            $data['name'] = Json::encode($this->name);
        }
        if ($this->billing_name !== null) {
            $data['billing_name'] = Json::encode($this->billing_name);
        }
        if ($this->email !== null) {
            $data['email'] = Json::encode($this->email);
        }
        if ($this->billing_address !== null) {
            $data['billing_address'] = Json::encode($this->billing_address);
        }
        if ($this->tax_id !== null) {
            $data['tax_id'] = Json::encode($this->tax_id);
        }
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
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