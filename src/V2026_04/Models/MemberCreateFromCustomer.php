<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema for creating a new member nested under a customer.
 *
 * The customer is taken from the URL path, so it's not part of the body.
 */
final class MemberCreateFromCustomer implements Model, Deserializable
{
    public function __construct(
        public readonly string $email,
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
        /**
         * @var string|null
         */
        public readonly ?string $external_id = null,
        /**
         * @var Role|null
         */
        public readonly ?Role $role = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $email = Json::toString(Json::get($data, 'email'));
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;
        /** @var string|null $external_id */
        $external_id = isset($data['external_id']) ? Json::toString($data['external_id']) : null;
        /** @var Role|null $role */
        $role = isset($data['role']) ? Role::from(Json::toString($data['role'])) : null;

        return new self(
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
        $data['email'] = Json::encode($this->email);
        if ($this->name !== null) {
            $data['name'] = Json::encode($this->name);
        }
        if ($this->external_id !== null) {
            $data['external_id'] = Json::encode($this->external_id);
        }
        if ($this->role !== null) {
            $data['role'] = Json::encode($this->role);
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