<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * OAuth2ClientConfiguration
 */
final class OAuth2ClientConfiguration implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<string>
         */
        public readonly array $redirect_uris,
        public readonly string $client_name,
        /**
         * @var TokenEndpointAuthMethod|null
         */
        public readonly ?TokenEndpointAuthMethod $token_endpoint_auth_method = null,
        /**
         * @var list<string>|null
         */
        public readonly ?array $grant_types = null,
        /**
         * @var list<string>|null
         */
        public readonly ?array $response_types = null,
        /**
         * @var string|null
         */
        public readonly ?string $scope = null,
        /**
         * @var string|null
         */
        public readonly ?string $client_uri = null,
        /**
         * @var string|null
         */
        public readonly ?string $logo_uri = null,
        /**
         * @var string|null
         */
        public readonly ?string $tos_uri = null,
        /**
         * @var string|null
         */
        public readonly ?string $policy_uri = null,
        /**
         * @var SubType|null
         */
        public readonly ?SubType $default_sub_type = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<string> $redirect_uris */
        $redirect_uris = array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList(Json::get($data, 'redirect_uris')));
        $client_name = Json::toString(Json::get($data, 'client_name'));
        /** @var TokenEndpointAuthMethod|null $token_endpoint_auth_method */
        $token_endpoint_auth_method = isset($data['token_endpoint_auth_method']) ? TokenEndpointAuthMethod::from(Json::toString($data['token_endpoint_auth_method'])) : null;
        /** @var list<string>|null $grant_types */
        $grant_types = isset($data['grant_types']) ? Json::toList($data['grant_types']) : null;
        /** @var list<string>|null $response_types */
        $response_types = isset($data['response_types']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList($data['response_types'])) : null;
        /** @var string|null $scope */
        $scope = isset($data['scope']) ? Json::toString($data['scope']) : null;
        /** @var string|null $client_uri */
        $client_uri = isset($data['client_uri']) ? Json::toString($data['client_uri']) : null;
        /** @var string|null $logo_uri */
        $logo_uri = isset($data['logo_uri']) ? Json::toString($data['logo_uri']) : null;
        /** @var string|null $tos_uri */
        $tos_uri = isset($data['tos_uri']) ? Json::toString($data['tos_uri']) : null;
        /** @var string|null $policy_uri */
        $policy_uri = isset($data['policy_uri']) ? Json::toString($data['policy_uri']) : null;
        /** @var SubType|null $default_sub_type */
        $default_sub_type = isset($data['default_sub_type']) ? SubType::from(Json::toString($data['default_sub_type'])) : null;

        return new self(
            redirect_uris: $redirect_uris,
            client_name: $client_name,
            token_endpoint_auth_method: $token_endpoint_auth_method,
            grant_types: $grant_types,
            response_types: $response_types,
            scope: $scope,
            client_uri: $client_uri,
            logo_uri: $logo_uri,
            tos_uri: $tos_uri,
            policy_uri: $policy_uri,
            default_sub_type: $default_sub_type,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['redirect_uris'] = Json::encode($this->redirect_uris);
        $data['client_name'] = Json::encode($this->client_name);
        if ($this->token_endpoint_auth_method !== null) {
            $data['token_endpoint_auth_method'] = Json::encode($this->token_endpoint_auth_method);
        }
        if ($this->grant_types !== null) {
            $data['grant_types'] = Json::encode($this->grant_types);
        }
        if ($this->response_types !== null) {
            $data['response_types'] = Json::encode($this->response_types);
        }
        if ($this->scope !== null) {
            $data['scope'] = Json::encode($this->scope);
        }
        if ($this->client_uri !== null) {
            $data['client_uri'] = Json::encode($this->client_uri);
        }
        if ($this->logo_uri !== null) {
            $data['logo_uri'] = Json::encode($this->logo_uri);
        }
        if ($this->tos_uri !== null) {
            $data['tos_uri'] = Json::encode($this->tos_uri);
        }
        if ($this->policy_uri !== null) {
            $data['policy_uri'] = Json::encode($this->policy_uri);
        }
        if ($this->default_sub_type !== null) {
            $data['default_sub_type'] = Json::encode($this->default_sub_type);
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