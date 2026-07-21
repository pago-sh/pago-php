<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema for updating a member.
 */
final class MemberUpdate implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
        /**
         * @var string|null
         */
        public readonly ?string $email = null,
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
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;
        /** @var string|null $email */
        $email = isset($data['email']) ? Json::toString($data['email']) : null;
        /** @var MemberRole|null $role */
        $role = isset($data['role']) ? MemberRole::from(Json::toString($data['role'])) : null;

        return new self(
            name: $name,
            email: $email,
            role: $role,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->name !== null) {
            $data['name'] = Json::encode($this->name);
        }
        if ($this->email !== null) {
            $data['email'] = Json::encode($this->email);
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