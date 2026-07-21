<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * SeatClaim
 */
final class SeatClaim implements Model, Deserializable
{
    public function __construct(
        public readonly string $invitation_token,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $invitation_token = Json::toString(Json::get($data, 'invitation_token'));

        return new self(
            invitation_token: $invitation_token,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['invitation_token'] = Json::encode($this->invitation_token);

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