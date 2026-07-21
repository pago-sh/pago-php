<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * TokenResponse
 */
final class TokenResponse implements Model, Deserializable
{
    public function __construct(
        public readonly string $access_token,
        public readonly string $token_type,
        public readonly int $expires_in,
        public readonly string $scope,
        /**
         * @var string|null
         */
        public readonly ?string $refresh_token = null,
        /**
         * @var string|null
         */
        public readonly ?string $id_token = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $access_token = Json::toString(Json::get($data, 'access_token'));
        $token_type = Json::toString(Json::get($data, 'token_type'));
        $expires_in = Json::toInt(Json::get($data, 'expires_in'));
        $scope = Json::toString(Json::get($data, 'scope'));
        /** @var string|null $refresh_token */
        $refresh_token = isset($data['refresh_token']) ? Json::toString($data['refresh_token']) : null;
        /** @var string|null $id_token */
        $id_token = isset($data['id_token']) ? Json::toString($data['id_token']) : null;

        return new self(
            access_token: $access_token,
            token_type: $token_type,
            expires_in: $expires_in,
            scope: $scope,
            refresh_token: $refresh_token,
            id_token: $id_token,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['access_token'] = Json::encode($this->access_token);
        $data['token_type'] = Json::encode($this->token_type);
        $data['expires_in'] = Json::encode($this->expires_in);
        $data['scope'] = Json::encode($this->scope);
        if ($this->refresh_token !== null) {
            $data['refresh_token'] = Json::encode($this->refresh_token);
        }
        if ($this->id_token !== null) {
            $data['id_token'] = Json::encode($this->id_token);
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