<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Properties to create a benefit of type `discord`.
 */
final class BenefitDiscordCreateProperties implements Model, Deserializable
{
    public function __construct(
        public readonly string $guild_token,
        public readonly string $role_id,
        public readonly bool $kick_member,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $guild_token = Json::toString(Json::get($data, 'guild_token'));
        $role_id = Json::toString(Json::get($data, 'role_id'));
        $kick_member = Json::toBool(Json::get($data, 'kick_member'));

        return new self(
            guild_token: $guild_token,
            role_id: $role_id,
            kick_member: $kick_member,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['guild_token'] = Json::encode($this->guild_token);
        $data['role_id'] = Json::encode($this->role_id);
        $data['kick_member'] = Json::encode($this->kick_member);

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