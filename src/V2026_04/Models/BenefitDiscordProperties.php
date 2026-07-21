<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Properties for a benefit of type `discord`.
 */
final class BenefitDiscordProperties implements Model, Deserializable
{
    public function __construct(
        public readonly string $guild_id,
        public readonly string $role_id,
        public readonly bool $kick_member,
        public readonly string $guild_token,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $guild_id = Json::toString(Json::get($data, 'guild_id'));
        $role_id = Json::toString(Json::get($data, 'role_id'));
        $kick_member = Json::toBool(Json::get($data, 'kick_member'));
        $guild_token = Json::toString(Json::get($data, 'guild_token'));

        return new self(
            guild_id: $guild_id,
            role_id: $role_id,
            kick_member: $kick_member,
            guild_token: $guild_token,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['guild_id'] = Json::encode($this->guild_id);
        $data['role_id'] = Json::encode($this->role_id);
        $data['kick_member'] = Json::encode($this->kick_member);
        $data['guild_token'] = Json::encode($this->guild_token);

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