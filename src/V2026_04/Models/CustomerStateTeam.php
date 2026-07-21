<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * A team customer along with additional state information:
 *
 * * Active subscriptions
 * * Granted benefits
 * * Active meters
 */
final class CustomerStateTeam implements Model, Deserializable, CustomerState
{
    public function __construct(
        public readonly string $id,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        /**
         * @var array<string, string|int|float|bool>
         */
        public readonly array $metadata,
        public readonly bool $email_verified,
        public readonly string $type,
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
        public readonly string $organization_id,
        /**
         * @var string|null
         */
        public readonly ?string $deleted_at,
        /**
         * @var string|null
         */
        public readonly ?string $avatar_url,
        /**
         * @var list<CustomerStateSubscription>
         */
        public readonly array $active_subscriptions,
        /**
         * @var list<CustomerStateBenefitGrant>
         */
        public readonly array $granted_benefits,
        /**
         * @var list<CustomerStateMeter>
         */
        public readonly array $active_meters,
        /**
         * @var string|null
         */
        public readonly ?string $external_id = null,
        /**
         * @var string|null
         */
        public readonly ?string $email = null,
        /**
         * @var string|null
         */
        public readonly ?string $locale = null,
        /**
         * @var string|null
         */
        public readonly ?string $default_payment_method_id = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $id = Json::toString(Json::get($data, 'id'));
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        /** @var array<string, string|int|float|bool> $metadata */
        $metadata = Json::toMap(Json::get($data, 'metadata'));
        $email_verified = Json::toBool(Json::get($data, 'email_verified'));
        $type = Json::toString(Json::get($data, 'type'));
        /** @var string|null $name */
        $name = (Json::get($data, 'name') === null ? null : Json::toString(Json::get($data, 'name')));
        /** @var string|null $billing_name */
        $billing_name = (Json::get($data, 'billing_name') === null ? null : Json::toString(Json::get($data, 'billing_name')));
        /** @var Address|null $billing_address */
        $billing_address = (Json::get($data, 'billing_address') === null ? null : Address::fromArray(Json::toMap(Json::get($data, 'billing_address'))));
        /** @var list<mixed>|null $tax_id */
        $tax_id = (Json::get($data, 'tax_id') === null ? null : Json::toList(Json::get($data, 'tax_id')));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        /** @var string|null $deleted_at */
        $deleted_at = (Json::get($data, 'deleted_at') === null ? null : Json::toString(Json::get($data, 'deleted_at')));
        /** @var string|null $avatar_url */
        $avatar_url = (Json::get($data, 'avatar_url') === null ? null : Json::toString(Json::get($data, 'avatar_url')));
        /** @var list<CustomerStateSubscription> $active_subscriptions */
        $active_subscriptions = array_map(static fn (mixed $item0): CustomerStateSubscription => CustomerStateSubscription::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'active_subscriptions')));
        /** @var list<CustomerStateBenefitGrant> $granted_benefits */
        $granted_benefits = array_map(static fn (mixed $item0): CustomerStateBenefitGrant => CustomerStateBenefitGrant::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'granted_benefits')));
        /** @var list<CustomerStateMeter> $active_meters */
        $active_meters = array_map(static fn (mixed $item0): CustomerStateMeter => CustomerStateMeter::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'active_meters')));
        /** @var string|null $external_id */
        $external_id = isset($data['external_id']) ? Json::toString($data['external_id']) : null;
        /** @var string|null $email */
        $email = isset($data['email']) ? Json::toString($data['email']) : null;
        /** @var string|null $locale */
        $locale = isset($data['locale']) ? Json::toString($data['locale']) : null;
        /** @var string|null $default_payment_method_id */
        $default_payment_method_id = isset($data['default_payment_method_id']) ? Json::toString($data['default_payment_method_id']) : null;

        return new self(
            id: $id,
            created_at: $created_at,
            modified_at: $modified_at,
            metadata: $metadata,
            email_verified: $email_verified,
            type: $type,
            name: $name,
            billing_name: $billing_name,
            billing_address: $billing_address,
            tax_id: $tax_id,
            organization_id: $organization_id,
            deleted_at: $deleted_at,
            avatar_url: $avatar_url,
            active_subscriptions: $active_subscriptions,
            granted_benefits: $granted_benefits,
            active_meters: $active_meters,
            external_id: $external_id,
            email: $email,
            locale: $locale,
            default_payment_method_id: $default_payment_method_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = Json::encode($this->id);
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['metadata'] = Json::encode($this->metadata);
        $data['email_verified'] = Json::encode($this->email_verified);
        $data['type'] = Json::encode($this->type);
        $data['name'] = Json::encode($this->name);
        $data['billing_name'] = Json::encode($this->billing_name);
        $data['billing_address'] = Json::encode($this->billing_address);
        $data['tax_id'] = Json::encode($this->tax_id);
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['deleted_at'] = Json::encode($this->deleted_at);
        $data['avatar_url'] = Json::encode($this->avatar_url);
        $data['active_subscriptions'] = Json::encode($this->active_subscriptions);
        $data['granted_benefits'] = Json::encode($this->granted_benefits);
        $data['active_meters'] = Json::encode($this->active_meters);
        if ($this->external_id !== null) {
            $data['external_id'] = Json::encode($this->external_id);
        }
        if ($this->email !== null) {
            $data['email'] = Json::encode($this->email);
        }
        if ($this->locale !== null) {
            $data['locale'] = Json::encode($this->locale);
        }
        if ($this->default_payment_method_id !== null) {
            $data['default_payment_method_id'] = Json::encode($this->default_payment_method_id);
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