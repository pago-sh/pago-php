<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * A customer session that can be used to authenticate as a customer.
 */
final class CustomerSession implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly string $token,
        public readonly string $expires_at,
        /**
         * @var string|null
         */
        public readonly ?string $return_url,
        public readonly string $customer_portal_url,
        public readonly string $customer_id,
        public readonly Customer $customer,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $id = Json::toString(Json::get($data, 'id'));
        $token = Json::toString(Json::get($data, 'token'));
        $expires_at = Json::toString(Json::get($data, 'expires_at'));
        /** @var string|null $return_url */
        $return_url = (Json::get($data, 'return_url') === null ? null : Json::toString(Json::get($data, 'return_url')));
        $customer_portal_url = Json::toString(Json::get($data, 'customer_portal_url'));
        $customer_id = Json::toString(Json::get($data, 'customer_id'));
        $customer = CustomerFactory::fromArray(Json::toMap(Json::get($data, 'customer')));

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            token: $token,
            expires_at: $expires_at,
            return_url: $return_url,
            customer_portal_url: $customer_portal_url,
            customer_id: $customer_id,
            customer: $customer,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['id'] = Json::encode($this->id);
        $data['token'] = Json::encode($this->token);
        $data['expires_at'] = Json::encode($this->expires_at);
        $data['return_url'] = Json::encode($this->return_url);
        $data['customer_portal_url'] = Json::encode($this->customer_portal_url);
        $data['customer_id'] = Json::encode($this->customer_id);
        $data['customer'] = Json::encode($this->customer);

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