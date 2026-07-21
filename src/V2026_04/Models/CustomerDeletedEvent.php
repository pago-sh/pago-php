<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * An event created by Pago when a customer is deleted.
 */
final class CustomerDeletedEvent implements Model, Deserializable, SystemEvent
{
    public function __construct(
        public readonly string $id,
        public readonly string $timestamp,
        public readonly string $organization_id,
        /**
         * @var string|null
         */
        public readonly ?string $customer_id,
        /**
         * @var Customer|null
         */
        public readonly ?Customer $customer,
        /**
         * @var string|null
         */
        public readonly ?string $external_customer_id,
        public readonly string $label,
        public readonly string $source,
        public readonly string $name,
        public readonly CustomerDeletedMetadata $metadata,
        /**
         * @var string|null
         */
        public readonly ?string $member_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $external_member_id = null,
        /**
         * @var int|null
         */
        public readonly ?int $child_count = null,
        /**
         * @var string|null
         */
        public readonly ?string $parent_id = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $id = Json::toString(Json::get($data, 'id'));
        $timestamp = Json::toString(Json::get($data, 'timestamp'));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        /** @var string|null $customer_id */
        $customer_id = (Json::get($data, 'customer_id') === null ? null : Json::toString(Json::get($data, 'customer_id')));
        /** @var Customer|null $customer */
        $customer = (Json::get($data, 'customer') === null ? null : CustomerFactory::fromArray(Json::toMap(Json::get($data, 'customer'))));
        /** @var string|null $external_customer_id */
        $external_customer_id = (Json::get($data, 'external_customer_id') === null ? null : Json::toString(Json::get($data, 'external_customer_id')));
        $label = Json::toString(Json::get($data, 'label'));
        $source = Json::toString(Json::get($data, 'source'));
        $name = Json::toString(Json::get($data, 'name'));
        $metadata = CustomerDeletedMetadata::fromArray(Json::toMap(Json::get($data, 'metadata')));
        /** @var string|null $member_id */
        $member_id = isset($data['member_id']) ? Json::toString($data['member_id']) : null;
        /** @var string|null $external_member_id */
        $external_member_id = isset($data['external_member_id']) ? Json::toString($data['external_member_id']) : null;
        /** @var int|null $child_count */
        $child_count = isset($data['child_count']) ? Json::toInt($data['child_count']) : null;
        /** @var string|null $parent_id */
        $parent_id = isset($data['parent_id']) ? Json::toString($data['parent_id']) : null;

        return new self(
            id: $id,
            timestamp: $timestamp,
            organization_id: $organization_id,
            customer_id: $customer_id,
            customer: $customer,
            external_customer_id: $external_customer_id,
            label: $label,
            source: $source,
            name: $name,
            metadata: $metadata,
            member_id: $member_id,
            external_member_id: $external_member_id,
            child_count: $child_count,
            parent_id: $parent_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = Json::encode($this->id);
        $data['timestamp'] = Json::encode($this->timestamp);
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['customer_id'] = Json::encode($this->customer_id);
        $data['customer'] = Json::encode($this->customer);
        $data['external_customer_id'] = Json::encode($this->external_customer_id);
        $data['label'] = Json::encode($this->label);
        $data['source'] = Json::encode($this->source);
        $data['name'] = Json::encode($this->name);
        $data['metadata'] = Json::encode($this->metadata);
        if ($this->member_id !== null) {
            $data['member_id'] = Json::encode($this->member_id);
        }
        if ($this->external_member_id !== null) {
            $data['external_member_id'] = Json::encode($this->external_member_id);
        }
        if ($this->child_count !== null) {
            $data['child_count'] = Json::encode($this->child_count);
        }
        if ($this->parent_id !== null) {
            $data['parent_id'] = Json::encode($this->parent_id);
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