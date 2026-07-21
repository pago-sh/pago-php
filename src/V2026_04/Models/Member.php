<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * A member of a customer.
 */
final class Member implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $customer_id,
        public readonly string $email,
        /**
         * @var string|null
         */
        public readonly ?string $name,
        /**
         * @var string|null
         */
        public readonly ?string $external_id,
        public readonly MemberRole $role,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $id = Json::toString(Json::get($data, 'id'));
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $customer_id = Json::toString(Json::get($data, 'customer_id'));
        $email = Json::toString(Json::get($data, 'email'));
        /** @var string|null $name */
        $name = (Json::get($data, 'name') === null ? null : Json::toString(Json::get($data, 'name')));
        /** @var string|null $external_id */
        $external_id = (Json::get($data, 'external_id') === null ? null : Json::toString(Json::get($data, 'external_id')));
        $role = MemberRole::from(Json::toString(Json::get($data, 'role')));

        return new self(
            id: $id,
            created_at: $created_at,
            modified_at: $modified_at,
            customer_id: $customer_id,
            email: $email,
            name: $name,
            external_id: $external_id,
            role: $role,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = Json::encode($this->id);
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['customer_id'] = Json::encode($this->customer_id);
        $data['email'] = Json::encode($this->email);
        $data['name'] = Json::encode($this->name);
        $data['external_id'] = Json::encode($this->external_id);
        $data['role'] = Json::encode($this->role);

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