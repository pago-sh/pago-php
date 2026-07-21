<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * IntrospectTokenResponse
 */
final class IntrospectTokenResponse implements Model, Deserializable
{
    public function __construct(
        public readonly bool $active,
        public readonly string $client_id,
        public readonly TokenType $token_type,
        public readonly string $scope,
        public readonly SubType $sub_type,
        public readonly string $sub,
        /**
         * @var list<string>
         */
        public readonly array $organizations,
        public readonly string $aud,
        public readonly string $iss,
        public readonly int $exp,
        public readonly int $iat,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $active = Json::toBool(Json::get($data, 'active'));
        $client_id = Json::toString(Json::get($data, 'client_id'));
        $token_type = TokenType::from(Json::toString(Json::get($data, 'token_type')));
        $scope = Json::toString(Json::get($data, 'scope'));
        $sub_type = SubType::from(Json::toString(Json::get($data, 'sub_type')));
        $sub = Json::toString(Json::get($data, 'sub'));
        /** @var list<string> $organizations */
        $organizations = array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList(Json::get($data, 'organizations')));
        $aud = Json::toString(Json::get($data, 'aud'));
        $iss = Json::toString(Json::get($data, 'iss'));
        $exp = Json::toInt(Json::get($data, 'exp'));
        $iat = Json::toInt(Json::get($data, 'iat'));

        return new self(
            active: $active,
            client_id: $client_id,
            token_type: $token_type,
            scope: $scope,
            sub_type: $sub_type,
            sub: $sub,
            organizations: $organizations,
            aud: $aud,
            iss: $iss,
            exp: $exp,
            iat: $iat,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['active'] = Json::encode($this->active);
        $data['client_id'] = Json::encode($this->client_id);
        $data['token_type'] = Json::encode($this->token_type);
        $data['scope'] = Json::encode($this->scope);
        $data['sub_type'] = Json::encode($this->sub_type);
        $data['sub'] = Json::encode($this->sub);
        $data['organizations'] = Json::encode($this->organizations);
        $data['aud'] = Json::encode($this->aud);
        $data['iss'] = Json::encode($this->iss);
        $data['exp'] = Json::encode($this->exp);
        $data['iat'] = Json::encode($this->iat);

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