<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerIndividualCreate
 */
final class CustomerIndividualCreate implements Model, Deserializable, CustomerCreate
{
    public function __construct(
        public readonly string $email,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
        /**
         * @var string|null
         */
        public readonly ?string $external_id = null,
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
        public readonly ?string $organization_id = null,
        /**
         * @var MemberOwnerCreate|null
         */
        public readonly ?MemberOwnerCreate $owner = null,
        /**
         * @var string|null
         */
        public readonly ?string $type = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $email = Json::toString(Json::get($data, 'email'));
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var string|null $external_id */
        $external_id = isset($data['external_id']) ? Json::toString($data['external_id']) : null;
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;
        /** @var AddressInput|null $billing_address */
        $billing_address = isset($data['billing_address']) ? AddressInput::fromArray(Json::toMap($data['billing_address'])) : null;
        /** @var string|null $tax_id */
        $tax_id = isset($data['tax_id']) ? Json::toString($data['tax_id']) : null;
        /** @var string|null $locale */
        $locale = isset($data['locale']) ? Json::toString($data['locale']) : null;
        /** @var string|null $organization_id */
        $organization_id = isset($data['organization_id']) ? Json::toString($data['organization_id']) : null;
        /** @var MemberOwnerCreate|null $owner */
        $owner = isset($data['owner']) ? MemberOwnerCreate::fromArray(Json::toMap($data['owner'])) : null;
        /** @var string|null $type */
        $type = isset($data['type']) ? Json::toString($data['type']) : null;

        return new self(
            email: $email,
            metadata: $metadata,
            external_id: $external_id,
            name: $name,
            billing_address: $billing_address,
            tax_id: $tax_id,
            locale: $locale,
            organization_id: $organization_id,
            owner: $owner,
            type: $type,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['email'] = Json::encode($this->email);
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->external_id !== null) {
            $data['external_id'] = Json::encode($this->external_id);
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
        if ($this->organization_id !== null) {
            $data['organization_id'] = Json::encode($this->organization_id);
        }
        if ($this->owner !== null) {
            $data['owner'] = Json::encode($this->owner);
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