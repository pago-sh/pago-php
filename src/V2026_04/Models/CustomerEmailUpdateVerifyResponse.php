<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerEmailUpdateVerifyResponse
 */
final class CustomerEmailUpdateVerifyResponse implements Model, Deserializable
{
    public function __construct(
        public readonly string $token,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $token = Json::toString(Json::get($data, 'token'));

        return new self(
            token: $token,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['token'] = Json::encode($this->token);

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