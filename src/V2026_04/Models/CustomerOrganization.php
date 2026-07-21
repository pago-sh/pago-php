<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerOrganization
 */
final class CustomerOrganization implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly string $name,
        public readonly string $slug,
        /**
         * @var string|null
         */
        public readonly ?string $avatar_url,
        public readonly SubscriptionProrationBehavior $proration_behavior,
        public readonly bool $allow_customer_updates,
        public readonly OrganizationCustomerPortalSettings $customer_portal_settings,
        /**
         * @var CustomerOrganizationFeatureSettings|null
         */
        public readonly ?CustomerOrganizationFeatureSettings $organization_features = null,
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
        $name = Json::toString(Json::get($data, 'name'));
        $slug = Json::toString(Json::get($data, 'slug'));
        /** @var string|null $avatar_url */
        $avatar_url = (Json::get($data, 'avatar_url') === null ? null : Json::toString(Json::get($data, 'avatar_url')));
        $proration_behavior = SubscriptionProrationBehavior::from(Json::toString(Json::get($data, 'proration_behavior')));
        $allow_customer_updates = Json::toBool(Json::get($data, 'allow_customer_updates'));
        $customer_portal_settings = OrganizationCustomerPortalSettings::fromArray(Json::toMap(Json::get($data, 'customer_portal_settings')));
        /** @var CustomerOrganizationFeatureSettings|null $organization_features */
        $organization_features = isset($data['organization_features']) ? CustomerOrganizationFeatureSettings::fromArray(Json::toMap($data['organization_features'])) : null;

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            name: $name,
            slug: $slug,
            avatar_url: $avatar_url,
            proration_behavior: $proration_behavior,
            allow_customer_updates: $allow_customer_updates,
            customer_portal_settings: $customer_portal_settings,
            organization_features: $organization_features,
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
        $data['name'] = Json::encode($this->name);
        $data['slug'] = Json::encode($this->slug);
        $data['avatar_url'] = Json::encode($this->avatar_url);
        $data['proration_behavior'] = Json::encode($this->proration_behavior);
        $data['allow_customer_updates'] = Json::encode($this->allow_customer_updates);
        $data['customer_portal_settings'] = Json::encode($this->customer_portal_settings);
        if ($this->organization_features !== null) {
            $data['organization_features'] = Json::encode($this->organization_features);
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