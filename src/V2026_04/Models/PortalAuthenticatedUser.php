<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Information about the authenticated portal user.
 */
final class PortalAuthenticatedUser implements Model, Deserializable
{
    public function __construct(
        public readonly string $type,
        /**
         * @var string|null
         */
        public readonly ?string $name,
        public readonly string $email,
        public readonly string $customer_id,
        /**
         * @var string|null
         */
        public readonly ?string $member_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $role = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $type = Json::toString(Json::get($data, 'type'));
        /** @var string|null $name */
        $name = (Json::get($data, 'name') === null ? null : Json::toString(Json::get($data, 'name')));
        $email = Json::toString(Json::get($data, 'email'));
        $customer_id = Json::toString(Json::get($data, 'customer_id'));
        /** @var string|null $member_id */
        $member_id = isset($data['member_id']) ? Json::toString($data['member_id']) : null;
        /** @var string|null $role */
        $role = isset($data['role']) ? Json::toString($data['role']) : null;

        return new self(
            type: $type,
            name: $name,
            email: $email,
            customer_id: $customer_id,
            member_id: $member_id,
            role: $role,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['type'] = Json::encode($this->type);
        $data['name'] = Json::encode($this->name);
        $data['email'] = Json::encode($this->email);
        $data['customer_id'] = Json::encode($this->customer_id);
        if ($this->member_id !== null) {
            $data['member_id'] = Json::encode($this->member_id);
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