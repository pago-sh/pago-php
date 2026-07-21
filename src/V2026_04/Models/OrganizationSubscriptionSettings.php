<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * OrganizationSubscriptionSettings
 */
final class OrganizationSubscriptionSettings implements Model, Deserializable
{
    public function __construct(
        public readonly bool $allow_multiple_subscriptions,
        public readonly PublicSubscriptionProrationBehavior $proration_behavior,
        public readonly int $benefit_revocation_grace_period,
        public readonly bool $prevent_trial_abuse,
        public readonly bool $allow_customer_updates,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $allow_multiple_subscriptions = Json::toBool(Json::get($data, 'allow_multiple_subscriptions'));
        $proration_behavior = PublicSubscriptionProrationBehavior::from(Json::toString(Json::get($data, 'proration_behavior')));
        $benefit_revocation_grace_period = Json::toInt(Json::get($data, 'benefit_revocation_grace_period'));
        $prevent_trial_abuse = Json::toBool(Json::get($data, 'prevent_trial_abuse'));
        $allow_customer_updates = Json::toBool(Json::get($data, 'allow_customer_updates'));

        return new self(
            allow_multiple_subscriptions: $allow_multiple_subscriptions,
            proration_behavior: $proration_behavior,
            benefit_revocation_grace_period: $benefit_revocation_grace_period,
            prevent_trial_abuse: $prevent_trial_abuse,
            allow_customer_updates: $allow_customer_updates,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['allow_multiple_subscriptions'] = Json::encode($this->allow_multiple_subscriptions);
        $data['proration_behavior'] = Json::encode($this->proration_behavior);
        $data['benefit_revocation_grace_period'] = Json::encode($this->benefit_revocation_grace_period);
        $data['prevent_trial_abuse'] = Json::encode($this->prevent_trial_abuse);
        $data['allow_customer_updates'] = Json::encode($this->allow_customer_updates);

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