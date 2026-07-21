<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * OrganizationCustomerEmailSettings
 */
final class OrganizationCustomerEmailSettings implements Model, Deserializable
{
    public function __construct(
        public readonly bool $order_confirmation,
        public readonly bool $subscription_cancellation,
        public readonly bool $subscription_confirmation,
        public readonly bool $subscription_cycled,
        public readonly bool $subscription_cycled_after_trial,
        public readonly bool $subscription_past_due,
        public readonly bool $subscription_paused,
        public readonly bool $subscription_resumed,
        public readonly bool $subscription_renewal_reminder,
        public readonly bool $subscription_revoked,
        public readonly bool $subscription_trial_conversion_reminder,
        public readonly bool $subscription_uncanceled,
        public readonly bool $subscription_updated,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $order_confirmation = Json::toBool(Json::get($data, 'order_confirmation'));
        $subscription_cancellation = Json::toBool(Json::get($data, 'subscription_cancellation'));
        $subscription_confirmation = Json::toBool(Json::get($data, 'subscription_confirmation'));
        $subscription_cycled = Json::toBool(Json::get($data, 'subscription_cycled'));
        $subscription_cycled_after_trial = Json::toBool(Json::get($data, 'subscription_cycled_after_trial'));
        $subscription_past_due = Json::toBool(Json::get($data, 'subscription_past_due'));
        $subscription_paused = Json::toBool(Json::get($data, 'subscription_paused'));
        $subscription_resumed = Json::toBool(Json::get($data, 'subscription_resumed'));
        $subscription_renewal_reminder = Json::toBool(Json::get($data, 'subscription_renewal_reminder'));
        $subscription_revoked = Json::toBool(Json::get($data, 'subscription_revoked'));
        $subscription_trial_conversion_reminder = Json::toBool(Json::get($data, 'subscription_trial_conversion_reminder'));
        $subscription_uncanceled = Json::toBool(Json::get($data, 'subscription_uncanceled'));
        $subscription_updated = Json::toBool(Json::get($data, 'subscription_updated'));

        return new self(
            order_confirmation: $order_confirmation,
            subscription_cancellation: $subscription_cancellation,
            subscription_confirmation: $subscription_confirmation,
            subscription_cycled: $subscription_cycled,
            subscription_cycled_after_trial: $subscription_cycled_after_trial,
            subscription_past_due: $subscription_past_due,
            subscription_paused: $subscription_paused,
            subscription_resumed: $subscription_resumed,
            subscription_renewal_reminder: $subscription_renewal_reminder,
            subscription_revoked: $subscription_revoked,
            subscription_trial_conversion_reminder: $subscription_trial_conversion_reminder,
            subscription_uncanceled: $subscription_uncanceled,
            subscription_updated: $subscription_updated,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['order_confirmation'] = Json::encode($this->order_confirmation);
        $data['subscription_cancellation'] = Json::encode($this->subscription_cancellation);
        $data['subscription_confirmation'] = Json::encode($this->subscription_confirmation);
        $data['subscription_cycled'] = Json::encode($this->subscription_cycled);
        $data['subscription_cycled_after_trial'] = Json::encode($this->subscription_cycled_after_trial);
        $data['subscription_past_due'] = Json::encode($this->subscription_past_due);
        $data['subscription_paused'] = Json::encode($this->subscription_paused);
        $data['subscription_resumed'] = Json::encode($this->subscription_resumed);
        $data['subscription_renewal_reminder'] = Json::encode($this->subscription_renewal_reminder);
        $data['subscription_revoked'] = Json::encode($this->subscription_revoked);
        $data['subscription_trial_conversion_reminder'] = Json::encode($this->subscription_trial_conversion_reminder);
        $data['subscription_uncanceled'] = Json::encode($this->subscription_uncanceled);
        $data['subscription_updated'] = Json::encode($this->subscription_updated);

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