<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema for creating an owner member during customer creation.
 */
final class MemberOwnerCreate implements Model, Deserializable
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

        return new self(
            email: $email,
            name: $name,
            external_id: $external_id,
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