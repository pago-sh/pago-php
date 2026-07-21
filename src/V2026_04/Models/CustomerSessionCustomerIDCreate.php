<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema for creating a customer session using a customer ID.
 */
final class CustomerSessionCustomerIDCreate implements Model, Deserializable
{
    public function __construct(
        public readonly string $customer_id,
        /**
         * @var string|null
         */
        public readonly ?string $member_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $external_member_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $return_url = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $customer_id = Json::toString(Json::get($data, 'customer_id'));
        /** @var string|null $member_id */
        $member_id = isset($data['member_id']) ? Json::toString($data['member_id']) : null;
        /** @var string|null $external_member_id */
        $external_member_id = isset($data['external_member_id']) ? Json::toString($data['external_member_id']) : null;
        /** @var string|null $return_url */
        $return_url = isset($data['return_url']) ? Json::toString($data['return_url']) : null;

        return new self(
            customer_id: $customer_id,
            member_id: $member_id,
            external_member_id: $external_member_id,
            return_url: $return_url,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['customer_id'] = Json::encode($this->customer_id);
        if ($this->member_id !== null) {
            $data['member_id'] = Json::encode($this->member_id);
        }
        if ($this->external_member_id !== null) {
            $data['external_member_id'] = Json::encode($this->external_member_id);
        }
        if ($this->return_url !== null) {
            $data['return_url'] = Json::encode($this->return_url);
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