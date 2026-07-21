<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * OrganizationCustomerPortalSettings
 */
final class OrganizationCustomerPortalSettings implements Model, Deserializable
{
    public function __construct(
        public readonly CustomerPortalUsageSettings $usage,
        public readonly CustomerPortalSubscriptionSettings $subscription,
        /**
         * @var CustomerPortalCustomerSettings|null
         */
        public readonly ?CustomerPortalCustomerSettings $customer = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $usage = CustomerPortalUsageSettings::fromArray(Json::toMap(Json::get($data, 'usage')));
        $subscription = CustomerPortalSubscriptionSettings::fromArray(Json::toMap(Json::get($data, 'subscription')));
        /** @var CustomerPortalCustomerSettings|null $customer */
        $customer = isset($data['customer']) ? CustomerPortalCustomerSettings::fromArray(Json::toMap($data['customer'])) : null;

        return new self(
            usage: $usage,
            subscription: $subscription,
            customer: $customer,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['usage'] = Json::encode($this->usage);
        $data['subscription'] = Json::encode($this->subscription);
        if ($this->customer !== null) {
            $data['customer'] = Json::encode($this->customer);
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