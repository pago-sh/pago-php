<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Organization
 */
final class Organization implements Model, Deserializable
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
        /**
         * @var string|null
         */
        public readonly ?string $email,
        /**
         * @var string|null
         */
        public readonly ?string $website,
        /**
         * @var list<OrganizationSocialLink>
         */
        public readonly array $socials,
        public readonly OrganizationStatus $status,
        /**
         * @var string|null
         */
        public readonly ?string $details_submitted_at,
        public readonly bool $sso_enforced,
        public readonly string $default_presentment_currency,
        public readonly TaxBehaviorOption $default_tax_behavior,
        /**
         * @var OrganizationFeatureSettings|null
         */
        public readonly ?OrganizationFeatureSettings $feature_settings,
        public readonly OrganizationSubscriptionSettings $subscription_settings,
        public readonly OrganizationCustomerEmailSettings $customer_email_settings,
        public readonly OrganizationCustomerPortalSettings $customer_portal_settings,
        /**
         * @var string|null
         */
        public readonly ?string $account_id,
        /**
         * @var string|null
         */
        public readonly ?string $payout_account_id,
        public readonly OrganizationCapabilities $capabilities,
        /**
         * @var CountryAlpha2|null
         */
        public readonly ?CountryAlpha2 $country = null,
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
        /** @var string|null $email */
        $email = (Json::get($data, 'email') === null ? null : Json::toString(Json::get($data, 'email')));
        /** @var string|null $website */
        $website = (Json::get($data, 'website') === null ? null : Json::toString(Json::get($data, 'website')));
        /** @var list<OrganizationSocialLink> $socials */
        $socials = array_map(static fn (mixed $item0): OrganizationSocialLink => OrganizationSocialLink::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'socials')));
        $status = OrganizationStatus::from(Json::toString(Json::get($data, 'status')));
        /** @var string|null $details_submitted_at */
        $details_submitted_at = (Json::get($data, 'details_submitted_at') === null ? null : Json::toString(Json::get($data, 'details_submitted_at')));
        $sso_enforced = Json::toBool(Json::get($data, 'sso_enforced'));
        $default_presentment_currency = Json::toString(Json::get($data, 'default_presentment_currency'));
        $default_tax_behavior = TaxBehaviorOption::from(Json::toString(Json::get($data, 'default_tax_behavior')));
        /** @var OrganizationFeatureSettings|null $feature_settings */
        $feature_settings = (Json::get($data, 'feature_settings') === null ? null : OrganizationFeatureSettings::fromArray(Json::toMap(Json::get($data, 'feature_settings'))));
        $subscription_settings = OrganizationSubscriptionSettings::fromArray(Json::toMap(Json::get($data, 'subscription_settings')));
        $customer_email_settings = OrganizationCustomerEmailSettings::fromArray(Json::toMap(Json::get($data, 'customer_email_settings')));
        $customer_portal_settings = OrganizationCustomerPortalSettings::fromArray(Json::toMap(Json::get($data, 'customer_portal_settings')));
        /** @var string|null $account_id */
        $account_id = (Json::get($data, 'account_id') === null ? null : Json::toString(Json::get($data, 'account_id')));
        /** @var string|null $payout_account_id */
        $payout_account_id = (Json::get($data, 'payout_account_id') === null ? null : Json::toString(Json::get($data, 'payout_account_id')));
        $capabilities = OrganizationCapabilities::fromArray(Json::toMap(Json::get($data, 'capabilities')));
        /** @var CountryAlpha2|null $country */
        $country = isset($data['country']) ? CountryAlpha2::from(Json::toString($data['country'])) : null;

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            name: $name,
            slug: $slug,
            avatar_url: $avatar_url,
            proration_behavior: $proration_behavior,
            allow_customer_updates: $allow_customer_updates,
            email: $email,
            website: $website,
            socials: $socials,
            status: $status,
            details_submitted_at: $details_submitted_at,
            sso_enforced: $sso_enforced,
            default_presentment_currency: $default_presentment_currency,
            default_tax_behavior: $default_tax_behavior,
            feature_settings: $feature_settings,
            subscription_settings: $subscription_settings,
            customer_email_settings: $customer_email_settings,
            customer_portal_settings: $customer_portal_settings,
            account_id: $account_id,
            payout_account_id: $payout_account_id,
            capabilities: $capabilities,
            country: $country,
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
        $data['email'] = Json::encode($this->email);
        $data['website'] = Json::encode($this->website);
        $data['socials'] = Json::encode($this->socials);
        $data['status'] = Json::encode($this->status);
        $data['details_submitted_at'] = Json::encode($this->details_submitted_at);
        $data['sso_enforced'] = Json::encode($this->sso_enforced);
        $data['default_presentment_currency'] = Json::encode($this->default_presentment_currency);
        $data['default_tax_behavior'] = Json::encode($this->default_tax_behavior);
        $data['feature_settings'] = Json::encode($this->feature_settings);
        $data['subscription_settings'] = Json::encode($this->subscription_settings);
        $data['customer_email_settings'] = Json::encode($this->customer_email_settings);
        $data['customer_portal_settings'] = Json::encode($this->customer_portal_settings);
        $data['account_id'] = Json::encode($this->account_id);
        $data['payout_account_id'] = Json::encode($this->payout_account_id);
        $data['capabilities'] = Json::encode($this->capabilities);
        if ($this->country !== null) {
            $data['country'] = Json::encode($this->country);
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