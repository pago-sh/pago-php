<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * An active customer subscription.
 */
final class CustomerStateSubscription implements Model, Deserializable
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
        public readonly Status $status,
        public readonly int $amount,
        public readonly string $currency,
        public readonly RecurringInterval $recurring_interval,
        public readonly string $current_period_start,
        public readonly string $current_period_end,
        /**
         * @var string|null
         */
        public readonly ?string $trial_start,
        /**
         * @var string|null
         */
        public readonly ?string $trial_end,
        public readonly bool $cancel_at_period_end,
        /**
         * @var string|null
         */
        public readonly ?string $canceled_at,
        /**
         * @var string|null
         */
        public readonly ?string $started_at,
        /**
         * @var string|null
         */
        public readonly ?string $ends_at,
        public readonly string $product_id,
        /**
         * @var string|null
         */
        public readonly ?string $discount_id,
        /**
         * @var list<CustomerStateSubscriptionMeter>
         */
        public readonly array $meters,
        /**
         * @var array<string, string|int|bool|null>|null
         */
        public readonly ?array $custom_field_data = null,
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
        $status = Status::from(Json::toString(Json::get($data, 'status')));
        $amount = Json::toInt(Json::get($data, 'amount'));
        $currency = Json::toString(Json::get($data, 'currency'));
        $recurring_interval = RecurringInterval::from(Json::toString(Json::get($data, 'recurring_interval')));
        $current_period_start = Json::toString(Json::get($data, 'current_period_start'));
        $current_period_end = Json::toString(Json::get($data, 'current_period_end'));
        /** @var string|null $trial_start */
        $trial_start = (Json::get($data, 'trial_start') === null ? null : Json::toString(Json::get($data, 'trial_start')));
        /** @var string|null $trial_end */
        $trial_end = (Json::get($data, 'trial_end') === null ? null : Json::toString(Json::get($data, 'trial_end')));
        $cancel_at_period_end = Json::toBool(Json::get($data, 'cancel_at_period_end'));
        /** @var string|null $canceled_at */
        $canceled_at = (Json::get($data, 'canceled_at') === null ? null : Json::toString(Json::get($data, 'canceled_at')));
        /** @var string|null $started_at */
        $started_at = (Json::get($data, 'started_at') === null ? null : Json::toString(Json::get($data, 'started_at')));
        /** @var string|null $ends_at */
        $ends_at = (Json::get($data, 'ends_at') === null ? null : Json::toString(Json::get($data, 'ends_at')));
        $product_id = Json::toString(Json::get($data, 'product_id'));
        /** @var string|null $discount_id */
        $discount_id = (Json::get($data, 'discount_id') === null ? null : Json::toString(Json::get($data, 'discount_id')));
        /** @var list<CustomerStateSubscriptionMeter> $meters */
        $meters = array_map(static fn (mixed $item0): CustomerStateSubscriptionMeter => CustomerStateSubscriptionMeter::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'meters')));
        /** @var array<string, string|int|bool|null>|null $custom_field_data */
        $custom_field_data = isset($data['custom_field_data']) ? Json::toMap($data['custom_field_data']) : null;

        return new self(
            id: $id,
            created_at: $created_at,
            modified_at: $modified_at,
            metadata: $metadata,
            status: $status,
            amount: $amount,
            currency: $currency,
            recurring_interval: $recurring_interval,
            current_period_start: $current_period_start,
            current_period_end: $current_period_end,
            trial_start: $trial_start,
            trial_end: $trial_end,
            cancel_at_period_end: $cancel_at_period_end,
            canceled_at: $canceled_at,
            started_at: $started_at,
            ends_at: $ends_at,
            product_id: $product_id,
            discount_id: $discount_id,
            meters: $meters,
            custom_field_data: $custom_field_data,
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
        $data['status'] = Json::encode($this->status);
        $data['amount'] = Json::encode($this->amount);
        $data['currency'] = Json::encode($this->currency);
        $data['recurring_interval'] = Json::encode($this->recurring_interval);
        $data['current_period_start'] = Json::encode($this->current_period_start);
        $data['current_period_end'] = Json::encode($this->current_period_end);
        $data['trial_start'] = Json::encode($this->trial_start);
        $data['trial_end'] = Json::encode($this->trial_end);
        $data['cancel_at_period_end'] = Json::encode($this->cancel_at_period_end);
        $data['canceled_at'] = Json::encode($this->canceled_at);
        $data['started_at'] = Json::encode($this->started_at);
        $data['ends_at'] = Json::encode($this->ends_at);
        $data['product_id'] = Json::encode($this->product_id);
        $data['discount_id'] = Json::encode($this->discount_id);
        $data['meters'] = Json::encode($this->meters);
        if ($this->custom_field_data !== null) {
            $data['custom_field_data'] = Json::encode($this->custom_field_data);
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