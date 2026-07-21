<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * OAuth2ClientPublic
 */
final class OAuth2ClientPublic implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $client_id,
        /**
         * @var string|null
         */
        public readonly ?string $client_name,
        /**
         * @var string|null
         */
        public readonly ?string $client_uri,
        /**
         * @var string|null
         */
        public readonly ?string $logo_uri,
        /**
         * @var string|null
         */
        public readonly ?string $tos_uri,
        /**
         * @var string|null
         */
        public readonly ?string $policy_uri,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $client_id = Json::toString(Json::get($data, 'client_id'));
        /** @var string|null $client_name */
        $client_name = (Json::get($data, 'client_name') === null ? null : Json::toString(Json::get($data, 'client_name')));
        /** @var string|null $client_uri */
        $client_uri = (Json::get($data, 'client_uri') === null ? null : Json::toString(Json::get($data, 'client_uri')));
        /** @var string|null $logo_uri */
        $logo_uri = (Json::get($data, 'logo_uri') === null ? null : Json::toString(Json::get($data, 'logo_uri')));
        /** @var string|null $tos_uri */
        $tos_uri = (Json::get($data, 'tos_uri') === null ? null : Json::toString(Json::get($data, 'tos_uri')));
        /** @var string|null $policy_uri */
        $policy_uri = (Json::get($data, 'policy_uri') === null ? null : Json::toString(Json::get($data, 'policy_uri')));

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            client_id: $client_id,
            client_name: $client_name,
            client_uri: $client_uri,
            logo_uri: $logo_uri,
            tos_uri: $tos_uri,
            policy_uri: $policy_uri,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['client_id'] = Json::encode($this->client_id);
        $data['client_name'] = Json::encode($this->client_name);
        $data['client_uri'] = Json::encode($this->client_uri);
        $data['logo_uri'] = Json::encode($this->logo_uri);
        $data['tos_uri'] = Json::encode($this->tos_uri);
        $data['policy_uri'] = Json::encode($this->policy_uri);

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