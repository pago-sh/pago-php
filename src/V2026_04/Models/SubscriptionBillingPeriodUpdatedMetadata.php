<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * SubscriptionBillingPeriodUpdatedMetadata
 */
final class SubscriptionBillingPeriodUpdatedMetadata implements Model, Deserializable
{
    public function __construct(
        public readonly string $subscription_id,
        public readonly string $old_period_end,
        public readonly string $new_period_end,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $subscription_id = Json::toString(Json::get($data, 'subscription_id'));
        $old_period_end = Json::toString(Json::get($data, 'old_period_end'));
        $new_period_end = Json::toString(Json::get($data, 'new_period_end'));

        return new self(
            subscription_id: $subscription_id,
            old_period_end: $old_period_end,
            new_period_end: $new_period_end,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['subscription_id'] = Json::encode($this->subscription_id);
        $data['old_period_end'] = Json::encode($this->old_period_end);
        $data['new_period_end'] = Json::encode($this->new_period_end);

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