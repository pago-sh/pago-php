<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * AuthorizeUser
 */
final class AuthorizeUser implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $email,
        /**
         * @var string|null
         */
        public readonly ?string $avatar_url,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $id = Json::toString(Json::get($data, 'id'));
        $email = Json::toString(Json::get($data, 'email'));
        /** @var string|null $avatar_url */
        $avatar_url = (Json::get($data, 'avatar_url') === null ? null : Json::toString(Json::get($data, 'avatar_url')));

        return new self(
            id: $id,
            email: $email,
            avatar_url: $avatar_url,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = Json::encode($this->id);
        $data['email'] = Json::encode($this->email);
        $data['avatar_url'] = Json::encode($this->avatar_url);

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