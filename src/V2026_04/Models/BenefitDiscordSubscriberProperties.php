<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Properties available to subscribers for a benefit of type `discord`.
 */
final class BenefitDiscordSubscriberProperties implements Model, Deserializable
{
    public function __construct(
        public readonly string $guild_id,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $guild_id = Json::toString(Json::get($data, 'guild_id'));

        return new self(
            guild_id: $guild_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['guild_id'] = Json::encode($this->guild_id);

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