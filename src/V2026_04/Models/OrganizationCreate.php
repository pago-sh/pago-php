<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * OrganizationCreate
 */
final class OrganizationCreate implements Model, Deserializable
{
    public function __construct(
        public readonly string $name,
        public readonly string $slug,
        /**
         * @var string|null
         */
        public readonly ?string $avatar_url = null,
        public readonly OrganizationIndividualLegalEntitySchema|OrganizationCompanyLegalEntitySchema|null $legal_entity = null,
        /**
         * @var string|null
         */
        public readonly ?string $email = null,
        /**
         * @var string|null
         */
        public readonly ?string $website = null,
        /**
         * @var list<OrganizationSocialLink>|null
         */
        public readonly ?array $socials = null,
        /**
         * @var OrganizationDetails|null
         */
        public readonly ?OrganizationDetails $details = null,
        /**
         * @var CountryAlpha2Input|null
         */
        public readonly ?CountryAlpha2Input $country = null,
        /**
         * @var OrganizationFeatureSettingsUpdate|null
         */
        public readonly ?OrganizationFeatureSettingsUpdate $feature_settings = null,
        /**
         * @var OrganizationSubscriptionSettings|null
         */
        public readonly ?OrganizationSubscriptionSettings $subscription_settings = null,
        /**
         * @var OrganizationCustomerEmailSettings|null
         */
        public readonly ?OrganizationCustomerEmailSettings $customer_email_settings = null,
        /**
         * @var OrganizationCustomerPortalSettings|null
         */
        public readonly ?OrganizationCustomerPortalSettings $customer_portal_settings = null,
        /**
         * @var PresentmentCurrency|null
         */
        public readonly ?PresentmentCurrency $default_presentment_currency = null,
        /**
         * @var TaxBehaviorOption|null
         */
        public readonly ?TaxBehaviorOption $default_tax_behavior = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $name = Json::toString(Json::get($data, 'name'));
        $slug = Json::toString(Json::get($data, 'slug'));
        /** @var string|null $avatar_url */
        $avatar_url = isset($data['avatar_url']) ? Json::toString($data['avatar_url']) : null;
        /** @var OrganizationIndividualLegalEntitySchema|OrganizationCompanyLegalEntitySchema|null $legal_entity */
        $legal_entity = isset($data['legal_entity']) ? Union::resolve($data['legal_entity'], 'type', ['company' => OrganizationCompanyLegalEntitySchema::class, 'individual' => OrganizationIndividualLegalEntitySchema::class], [OrganizationIndividualLegalEntitySchema::class, OrganizationCompanyLegalEntitySchema::class]) : null;
        /** @var string|null $email */
        $email = isset($data['email']) ? Json::toString($data['email']) : null;
        /** @var string|null $website */
        $website = isset($data['website']) ? Json::toString($data['website']) : null;
        /** @var list<OrganizationSocialLink>|null $socials */
        $socials = isset($data['socials']) ? array_map(static fn (mixed $item0): OrganizationSocialLink => OrganizationSocialLink::fromArray(Json::toMap($item0)), Json::toList($data['socials'])) : null;
        /** @var OrganizationDetails|null $details */
        $details = isset($data['details']) ? OrganizationDetails::fromArray(Json::toMap($data['details'])) : null;
        /** @var CountryAlpha2Input|null $country */
        $country = isset($data['country']) ? CountryAlpha2Input::from(Json::toString($data['country'])) : null;
        /** @var OrganizationFeatureSettingsUpdate|null $feature_settings */
        $feature_settings = isset($data['feature_settings']) ? OrganizationFeatureSettingsUpdate::fromArray(Json::toMap($data['feature_settings'])) : null;
        /** @var OrganizationSubscriptionSettings|null $subscription_settings */
        $subscription_settings = isset($data['subscription_settings']) ? OrganizationSubscriptionSettings::fromArray(Json::toMap($data['subscription_settings'])) : null;
        /** @var OrganizationCustomerEmailSettings|null $customer_email_settings */
        $customer_email_settings = isset($data['customer_email_settings']) ? OrganizationCustomerEmailSettings::fromArray(Json::toMap($data['customer_email_settings'])) : null;
        /** @var OrganizationCustomerPortalSettings|null $customer_portal_settings */
        $customer_portal_settings = isset($data['customer_portal_settings']) ? OrganizationCustomerPortalSettings::fromArray(Json::toMap($data['customer_portal_settings'])) : null;
        /** @var PresentmentCurrency|null $default_presentment_currency */
        $default_presentment_currency = isset($data['default_presentment_currency']) ? PresentmentCurrency::from(Json::toString($data['default_presentment_currency'])) : null;
        /** @var TaxBehaviorOption|null $default_tax_behavior */
        $default_tax_behavior = isset($data['default_tax_behavior']) ? TaxBehaviorOption::from(Json::toString($data['default_tax_behavior'])) : null;

        return new self(
            name: $name,
            slug: $slug,
            avatar_url: $avatar_url,
            legal_entity: $legal_entity,
            email: $email,
            website: $website,
            socials: $socials,
            details: $details,
            country: $country,
            feature_settings: $feature_settings,
            subscription_settings: $subscription_settings,
            customer_email_settings: $customer_email_settings,
            customer_portal_settings: $customer_portal_settings,
            default_presentment_currency: $default_presentment_currency,
            default_tax_behavior: $default_tax_behavior,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = Json::encode($this->name);
        $data['slug'] = Json::encode($this->slug);
        if ($this->avatar_url !== null) {
            $data['avatar_url'] = Json::encode($this->avatar_url);
        }
        if ($this->legal_entity !== null) {
            $data['legal_entity'] = Json::encode($this->legal_entity);
        }
        if ($this->email !== null) {
            $data['email'] = Json::encode($this->email);
        }
        if ($this->website !== null) {
            $data['website'] = Json::encode($this->website);
        }
        if ($this->socials !== null) {
            $data['socials'] = Json::encode($this->socials);
        }
        if ($this->details !== null) {
            $data['details'] = Json::encode($this->details);
        }
        if ($this->country !== null) {
            $data['country'] = Json::encode($this->country);
        }
        if ($this->feature_settings !== null) {
            $data['feature_settings'] = Json::encode($this->feature_settings);
        }
        if ($this->subscription_settings !== null) {
            $data['subscription_settings'] = Json::encode($this->subscription_settings);
        }
        if ($this->customer_email_settings !== null) {
            $data['customer_email_settings'] = Json::encode($this->customer_email_settings);
        }
        if ($this->customer_portal_settings !== null) {
            $data['customer_portal_settings'] = Json::encode($this->customer_portal_settings);
        }
        if ($this->default_presentment_currency !== null) {
            $data['default_presentment_currency'] = Json::encode($this->default_presentment_currency);
        }
        if ($this->default_tax_behavior !== null) {
            $data['default_tax_behavior'] = Json::encode($this->default_tax_behavior);
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