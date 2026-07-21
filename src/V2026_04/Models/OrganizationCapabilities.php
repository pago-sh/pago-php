<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * OrganizationCapabilities
 */
final class OrganizationCapabilities implements Model, Deserializable
{
    public function __construct(
        public readonly bool $checkout_payments,
        public readonly bool $subscription_renewals,
        public readonly bool $payouts,
        public readonly bool $refunds,
        public readonly bool $api_access,
        public readonly bool $dashboard_access,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $checkout_payments = Json::toBool(Json::get($data, 'checkout_payments'));
        $subscription_renewals = Json::toBool(Json::get($data, 'subscription_renewals'));
        $payouts = Json::toBool(Json::get($data, 'payouts'));
        $refunds = Json::toBool(Json::get($data, 'refunds'));
        $api_access = Json::toBool(Json::get($data, 'api_access'));
        $dashboard_access = Json::toBool(Json::get($data, 'dashboard_access'));

        return new self(
            checkout_payments: $checkout_payments,
            subscription_renewals: $subscription_renewals,
            payouts: $payouts,
            refunds: $refunds,
            api_access: $api_access,
            dashboard_access: $dashboard_access,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['checkout_payments'] = Json::encode($this->checkout_payments);
        $data['subscription_renewals'] = Json::encode($this->subscription_renewals);
        $data['payouts'] = Json::encode($this->payouts);
        $data['refunds'] = Json::encode($this->refunds);
        $data['api_access'] = Json::encode($this->api_access);
        $data['dashboard_access'] = Json::encode($this->dashboard_access);

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