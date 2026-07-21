<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * SubscriptionUpdateBillingPeriod
 */
final class SubscriptionUpdateBillingPeriod implements Model, Deserializable, SubscriptionUpdate
{
    public function __construct(
        public readonly string $current_billing_period_end,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $current_billing_period_end = Json::toString(Json::get($data, 'current_billing_period_end'));

        return new self(
            current_billing_period_end: $current_billing_period_end,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['current_billing_period_end'] = Json::encode($this->current_billing_period_end);

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