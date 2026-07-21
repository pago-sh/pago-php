<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerSeatAssign
 */
final class CustomerSeatAssign implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $subscription_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $order_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $email = null,
        /**
         * @var string|null
         */
        public readonly ?string $external_customer_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $customer_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $external_member_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $member_id = null,
        /**
         * @var array<string, mixed>|null
         */
        public readonly ?array $metadata = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $immediate_claim = null,
        /**
         * @var string|null
         */
        public readonly ?string $checkout_id = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $subscription_id */
        $subscription_id = isset($data['subscription_id']) ? Json::toString($data['subscription_id']) : null;
        /** @var string|null $order_id */
        $order_id = isset($data['order_id']) ? Json::toString($data['order_id']) : null;
        /** @var string|null $email */
        $email = isset($data['email']) ? Json::toString($data['email']) : null;
        /** @var string|null $external_customer_id */
        $external_customer_id = isset($data['external_customer_id']) ? Json::toString($data['external_customer_id']) : null;
        /** @var string|null $customer_id */
        $customer_id = isset($data['customer_id']) ? Json::toString($data['customer_id']) : null;
        /** @var string|null $external_member_id */
        $external_member_id = isset($data['external_member_id']) ? Json::toString($data['external_member_id']) : null;
        /** @var string|null $member_id */
        $member_id = isset($data['member_id']) ? Json::toString($data['member_id']) : null;
        /** @var array<string, mixed>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var bool|null $immediate_claim */
        $immediate_claim = isset($data['immediate_claim']) ? Json::toBool($data['immediate_claim']) : null;
        /** @var string|null $checkout_id */
        $checkout_id = isset($data['checkout_id']) ? Json::toString($data['checkout_id']) : null;

        return new self(
            subscription_id: $subscription_id,
            order_id: $order_id,
            email: $email,
            external_customer_id: $external_customer_id,
            customer_id: $customer_id,
            external_member_id: $external_member_id,
            member_id: $member_id,
            metadata: $metadata,
            immediate_claim: $immediate_claim,
            checkout_id: $checkout_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->subscription_id !== null) {
            $data['subscription_id'] = Json::encode($this->subscription_id);
        }
        if ($this->order_id !== null) {
            $data['order_id'] = Json::encode($this->order_id);
        }
        if ($this->email !== null) {
            $data['email'] = Json::encode($this->email);
        }
        if ($this->external_customer_id !== null) {
            $data['external_customer_id'] = Json::encode($this->external_customer_id);
        }
        if ($this->customer_id !== null) {
            $data['customer_id'] = Json::encode($this->customer_id);
        }
        if ($this->external_member_id !== null) {
            $data['external_member_id'] = Json::encode($this->external_member_id);
        }
        if ($this->member_id !== null) {
            $data['member_id'] = Json::encode($this->member_id);
        }
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->immediate_claim !== null) {
            $data['immediate_claim'] = Json::encode($this->immediate_claim);
        }
        if ($this->checkout_id !== null) {
            $data['checkout_id'] = Json::encode($this->checkout_id);
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