<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema for adding a new member to the customer's team.
 */
final class CustomerPortalMemberCreate implements Model, Deserializable
{
    public function __construct(
        public readonly string $email,
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
        /**
         * @var MemberRole|null
         */
        public readonly ?MemberRole $role = null,
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
        /** @var MemberRole|null $role */
        $role = isset($data['role']) ? MemberRole::from(Json::toString($data['role'])) : null;

        return new self(
            email: $email,
            name: $name,
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