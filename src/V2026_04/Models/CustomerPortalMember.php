<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * A member of the customer's team as seen in the customer portal.
 */
final class CustomerPortalMember implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly string $email,
        /**
         * @var string|null
         */
        public readonly ?string $name,
        public readonly MemberRole $role,
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
        $email = Json::toString(Json::get($data, 'email'));
        /** @var string|null $name */
        $name = (Json::get($data, 'name') === null ? null : Json::toString(Json::get($data, 'name')));
        $role = MemberRole::from(Json::toString(Json::get($data, 'role')));

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
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
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['id'] = Json::encode($this->id);
        $data['email'] = Json::encode($this->email);
        $data['name'] = Json::encode($this->name);
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