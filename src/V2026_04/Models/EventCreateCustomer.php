<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * EventCreateCustomer
 */
final class EventCreateCustomer implements Model, Deserializable
{
    public function __construct(
        public readonly string $name,
        public readonly string $customer_id,
        /**
         * @var string|null
         */
        public readonly ?string $timestamp = null,
        /**
         * @var string|null
         */
        public readonly ?string $organization_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $external_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $parent_id = null,
        /**
         * @var EventMetadataInput|null
         */
        public readonly ?EventMetadataInput $metadata = null,
        /**
         * @var string|null
         */
        public readonly ?string $member_id = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $name = Json::toString(Json::get($data, 'name'));
        $customer_id = Json::toString(Json::get($data, 'customer_id'));
        /** @var string|null $timestamp */
        $timestamp = isset($data['timestamp']) ? Json::toString($data['timestamp']) : null;
        /** @var string|null $organization_id */
        $organization_id = isset($data['organization_id']) ? Json::toString($data['organization_id']) : null;
        /** @var string|null $external_id */
        $external_id = isset($data['external_id']) ? Json::toString($data['external_id']) : null;
        /** @var string|null $parent_id */
        $parent_id = isset($data['parent_id']) ? Json::toString($data['parent_id']) : null;
        /** @var EventMetadataInput|null $metadata */
        $metadata = isset($data['metadata']) ? EventMetadataInput::fromArray(Json::toMap($data['metadata'])) : null;
        /** @var string|null $member_id */
        $member_id = isset($data['member_id']) ? Json::toString($data['member_id']) : null;

        return new self(
            name: $name,
            customer_id: $customer_id,
            timestamp: $timestamp,
            organization_id: $organization_id,
            external_id: $external_id,
            parent_id: $parent_id,
            metadata: $metadata,
            member_id: $member_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = Json::encode($this->name);
        $data['customer_id'] = Json::encode($this->customer_id);
        if ($this->timestamp !== null) {
            $data['timestamp'] = Json::encode($this->timestamp);
        }
        if ($this->organization_id !== null) {
            $data['organization_id'] = Json::encode($this->organization_id);
        }
        if ($this->external_id !== null) {
            $data['external_id'] = Json::encode($this->external_id);
        }
        if ($this->parent_id !== null) {
            $data['parent_id'] = Json::encode($this->parent_id);
        }
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->member_id !== null) {
            $data['member_id'] = Json::encode($this->member_id);
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