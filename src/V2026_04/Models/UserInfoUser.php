<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * UserInfoUser
 */
final class UserInfoUser implements Model, Deserializable
{
    public function __construct(
        public readonly string $sub,
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
        /**
         * @var string|null
         */
        public readonly ?string $email = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $email_verified = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $sub = Json::toString(Json::get($data, 'sub'));
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;
        /** @var string|null $email */
        $email = isset($data['email']) ? Json::toString($data['email']) : null;
        /** @var bool|null $email_verified */
        $email_verified = isset($data['email_verified']) ? Json::toBool($data['email_verified']) : null;

        return new self(
            sub: $sub,
            name: $name,
            email: $email,
            email_verified: $email_verified,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['sub'] = Json::encode($this->sub);
        if ($this->name !== null) {
            $data['name'] = Json::encode($this->name);
        }
        if ($this->email !== null) {
            $data['email'] = Json::encode($this->email);
        }
        if ($this->email_verified !== null) {
            $data['email_verified'] = Json::encode($this->email_verified);
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