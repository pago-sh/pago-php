<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * AuthorizeResponseOrganization
 */
final class AuthorizeResponseOrganization implements Model, Deserializable
{
    public function __construct(
        public readonly OAuth2ClientPublic $client,
        public readonly string $sub_type,
        /**
         * @var AuthorizeOrganization|null
         */
        public readonly ?AuthorizeOrganization $sub,
        /**
         * @var list<Scope>
         */
        public readonly array $scopes,
        /**
         * @var list<AuthorizeOrganization>
         */
        public readonly array $organizations,
        /**
         * @var bool|null
         */
        public readonly ?bool $requires_single_organization = null,
        /**
         * @var array<string, string>|null
         */
        public readonly ?array $scope_display_names = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $client = OAuth2ClientPublic::fromArray(Json::toMap(Json::get($data, 'client')));
        $sub_type = Json::toString(Json::get($data, 'sub_type'));
        /** @var AuthorizeOrganization|null $sub */
        $sub = (Json::get($data, 'sub') === null ? null : AuthorizeOrganization::fromArray(Json::toMap(Json::get($data, 'sub'))));
        /** @var list<Scope> $scopes */
        $scopes = array_map(static fn (mixed $item0): Scope => Scope::from(Json::toString($item0)), Json::toList(Json::get($data, 'scopes')));
        /** @var list<AuthorizeOrganization> $organizations */
        $organizations = array_map(static fn (mixed $item0): AuthorizeOrganization => AuthorizeOrganization::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'organizations')));
        /** @var bool|null $requires_single_organization */
        $requires_single_organization = isset($data['requires_single_organization']) ? Json::toBool($data['requires_single_organization']) : null;
        /** @var array<string, string>|null $scope_display_names */
        $scope_display_names = isset($data['scope_display_names']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toMap($data['scope_display_names'])) : null;

        return new self(
            client: $client,
            sub_type: $sub_type,
            sub: $sub,
            scopes: $scopes,
            organizations: $organizations,
            requires_single_organization: $requires_single_organization,
            scope_display_names: $scope_display_names,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['client'] = Json::encode($this->client);
        $data['sub_type'] = Json::encode($this->sub_type);
        $data['sub'] = Json::encode($this->sub);
        $data['scopes'] = Json::encode($this->scopes);
        $data['organizations'] = Json::encode($this->organizations);
        if ($this->requires_single_organization !== null) {
            $data['requires_single_organization'] = Json::encode($this->requires_single_organization);
        }
        if ($this->scope_display_names !== null) {
            $data['scope_display_names'] = Json::encode($this->scope_display_names);
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