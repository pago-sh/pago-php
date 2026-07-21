<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerPortalCustomer
 */
final class CustomerPortalCustomer implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        /**
         * @var string|null
         */
        public readonly ?string $email,
        public readonly bool $email_verified,
        /**
         * @var string|null
         */
        public readonly ?string $name,
        /**
         * @var string|null
         */
        public readonly ?string $billing_name,
        /**
         * @var Address|null
         */
        public readonly ?Address $billing_address,
        /**
         * @var list<mixed>|null
         */
        public readonly ?array $tax_id,
        /**
         * @var array<string, CustomerPortalOAuthAccount>
         */
        public readonly array $oauth_accounts,
        /**
         * @var string|null
         */
        public readonly ?string $default_payment_method_id = null,
        /**
         * @var CustomerType|null
         */
        public readonly ?CustomerType $type = null,
        /**
         * @var string|null
         */
        public readonly ?string $locale = null,
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
        $id = Json::toString(Json::get($data, 'id'));
        /** @var string|null $email */
        $email = (Json::get($data, 'email') === null ? null : Json::toString(Json::get($data, 'email')));
        $email_verified = Json::toBool(Json::get($data, 'email_verified'));
        /** @var string|null $name */
        $name = (Json::get($data, 'name') === null ? null : Json::toString(Json::get($data, 'name')));
        /** @var string|null $billing_name */
        $billing_name = (Json::get($data, 'billing_name') === null ? null : Json::toString(Json::get($data, 'billing_name')));
        /** @var Address|null $billing_address */
        $billing_address = (Json::get($data, 'billing_address') === null ? null : Address::fromArray(Json::toMap(Json::get($data, 'billing_address'))));
        /** @var list<mixed>|null $tax_id */
        $tax_id = (Json::get($data, 'tax_id') === null ? null : Json::toList(Json::get($data, 'tax_id')));
        /** @var array<string, CustomerPortalOAuthAccount> $oauth_accounts */
        $oauth_accounts = array_map(static fn (mixed $item0): CustomerPortalOAuthAccount => CustomerPortalOAuthAccount::fromArray(Json::toMap($item0)), Json::toMap(Json::get($data, 'oauth_accounts')));
        /** @var string|null $default_payment_method_id */
        $default_payment_method_id = isset($data['default_payment_method_id']) ? Json::toString($data['default_payment_method_id']) : null;
        /** @var CustomerType|null $type */
        $type = isset($data['type']) ? CustomerType::from(Json::toString($data['type'])) : null;
        /** @var string|null $locale */
        $locale = isset($data['locale']) ? Json::toString($data['locale']) : null;

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            email: $email,
            email_verified: $email_verified,
            name: $name,
            billing_name: $billing_name,
            billing_address: $billing_address,
            tax_id: $tax_id,
            oauth_accounts: $oauth_accounts,
            default_payment_method_id: $default_payment_method_id,
            type: $type,
            locale: $locale,
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
        $data['id'] = Json::encode($this->id);
        $data['email'] = Json::encode($this->email);
        $data['email_verified'] = Json::encode($this->email_verified);
        $data['name'] = Json::encode($this->name);
        $data['billing_name'] = Json::encode($this->billing_name);
        $data['billing_address'] = Json::encode($this->billing_address);
        $data['tax_id'] = Json::encode($this->tax_id);
        $data['oauth_accounts'] = Json::encode($this->oauth_accounts);
        if ($this->default_payment_method_id !== null) {
            $data['default_payment_method_id'] = Json::encode($this->default_payment_method_id);
        }
        if ($this->type !== null) {
            $data['type'] = Json::encode($this->type);
        }
        if ($this->locale !== null) {
            $data['locale'] = Json::encode($this->locale);
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