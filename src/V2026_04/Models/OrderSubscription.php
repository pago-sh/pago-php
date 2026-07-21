<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * OrderSubscription
 */
final class OrderSubscription implements Model, Deserializable
{
    public function __construct(
        /**
         * @var array<string, string|int|float|bool>
         */
        public readonly array $metadata,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly int $amount,
        public readonly string $currency,
        public readonly RecurringInterval $recurring_interval,
        public readonly int $recurring_interval_count,
        public readonly SubscriptionStatus $status,
        public readonly string $current_period_start,
        public readonly string $current_period_end,
        /**
         * @var string|null
         */
        public readonly ?string $current_meter_period_start,
        /**
         * @var string|null
         */
        public readonly ?string $current_meter_period_end,
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
        /**
         * @var string|null
         */
        public readonly ?string $ended_at,
        public readonly bool $pause_at_period_end,
        /**
         * @var string|null
         */
        public readonly ?string $paused_at,
        /**
         * @var string|null
         */
        public readonly ?string $resumes_at,
        public readonly string $customer_id,
        public readonly string $product_id,
        /**
         * @var string|null
         */
        public readonly ?string $discount_id,
        /**
         * @var string|null
         */
        public readonly ?string $checkout_id,
        /**
         * @var CustomerCancellationReason|null
         */
        public readonly ?CustomerCancellationReason $customer_cancellation_reason,
        /**
         * @var string|null
         */
        public readonly ?string $customer_cancellation_comment,
        /**
         * @var string|null
         */
        public readonly ?string $past_due_at = null,
        /**
         * @var int|null
         */
        public readonly ?int $seats = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var array<string, string|int|float|bool> $metadata */
        $metadata = Json::toMap(Json::get($data, 'metadata'));
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $id = Json::toString(Json::get($data, 'id'));
        $amount = Json::toInt(Json::get($data, 'amount'));
        $currency = Json::toString(Json::get($data, 'currency'));
        $recurring_interval = RecurringInterval::from(Json::toString(Json::get($data, 'recurring_interval')));
        $recurring_interval_count = Json::toInt(Json::get($data, 'recurring_interval_count'));
        $status = SubscriptionStatus::from(Json::toString(Json::get($data, 'status')));
        $current_period_start = Json::toString(Json::get($data, 'current_period_start'));
        $current_period_end = Json::toString(Json::get($data, 'current_period_end'));
        /** @var string|null $current_meter_period_start */
        $current_meter_period_start = (Json::get($data, 'current_meter_period_start') === null ? null : Json::toString(Json::get($data, 'current_meter_period_start')));
        /** @var string|null $current_meter_period_end */
        $current_meter_period_end = (Json::get($data, 'current_meter_period_end') === null ? null : Json::toString(Json::get($data, 'current_meter_period_end')));
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
        /** @var string|null $ended_at */
        $ended_at = (Json::get($data, 'ended_at') === null ? null : Json::toString(Json::get($data, 'ended_at')));
        $pause_at_period_end = Json::toBool(Json::get($data, 'pause_at_period_end'));
        /** @var string|null $paused_at */
        $paused_at = (Json::get($data, 'paused_at') === null ? null : Json::toString(Json::get($data, 'paused_at')));
        /** @var string|null $resumes_at */
        $resumes_at = (Json::get($data, 'resumes_at') === null ? null : Json::toString(Json::get($data, 'resumes_at')));
        $customer_id = Json::toString(Json::get($data, 'customer_id'));
        $product_id = Json::toString(Json::get($data, 'product_id'));
        /** @var string|null $discount_id */
        $discount_id = (Json::get($data, 'discount_id') === null ? null : Json::toString(Json::get($data, 'discount_id')));
        /** @var string|null $checkout_id */
        $checkout_id = (Json::get($data, 'checkout_id') === null ? null : Json::toString(Json::get($data, 'checkout_id')));
        /** @var CustomerCancellationReason|null $customer_cancellation_reason */
        $customer_cancellation_reason = (Json::get($data, 'customer_cancellation_reason') === null ? null : CustomerCancellationReason::from(Json::toString(Json::get($data, 'customer_cancellation_reason'))));
        /** @var string|null $customer_cancellation_comment */
        $customer_cancellation_comment = (Json::get($data, 'customer_cancellation_comment') === null ? null : Json::toString(Json::get($data, 'customer_cancellation_comment')));
        /** @var string|null $past_due_at */
        $past_due_at = isset($data['past_due_at']) ? Json::toString($data['past_due_at']) : null;
        /** @var int|null $seats */
        $seats = isset($data['seats']) ? Json::toInt($data['seats']) : null;

        return new self(
            metadata: $metadata,
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            amount: $amount,
            currency: $currency,
            recurring_interval: $recurring_interval,
            recurring_interval_count: $recurring_interval_count,
            status: $status,
            current_period_start: $current_period_start,
            current_period_end: $current_period_end,
            current_meter_period_start: $current_meter_period_start,
            current_meter_period_end: $current_meter_period_end,
            trial_start: $trial_start,
            trial_end: $trial_end,
            cancel_at_period_end: $cancel_at_period_end,
            canceled_at: $canceled_at,
            started_at: $started_at,
            ends_at: $ends_at,
            ended_at: $ended_at,
            pause_at_period_end: $pause_at_period_end,
            paused_at: $paused_at,
            resumes_at: $resumes_at,
            customer_id: $customer_id,
            product_id: $product_id,
            discount_id: $discount_id,
            checkout_id: $checkout_id,
            customer_cancellation_reason: $customer_cancellation_reason,
            customer_cancellation_comment: $customer_cancellation_comment,
            past_due_at: $past_due_at,
            seats: $seats,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['metadata'] = Json::encode($this->metadata);
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['id'] = Json::encode($this->id);
        $data['amount'] = Json::encode($this->amount);
        $data['currency'] = Json::encode($this->currency);
        $data['recurring_interval'] = Json::encode($this->recurring_interval);
        $data['recurring_interval_count'] = Json::encode($this->recurring_interval_count);
        $data['status'] = Json::encode($this->status);
        $data['current_period_start'] = Json::encode($this->current_period_start);
        $data['current_period_end'] = Json::encode($this->current_period_end);
        $data['current_meter_period_start'] = Json::encode($this->current_meter_period_start);
        $data['current_meter_period_end'] = Json::encode($this->current_meter_period_end);
        $data['trial_start'] = Json::encode($this->trial_start);
        $data['trial_end'] = Json::encode($this->trial_end);
        $data['cancel_at_period_end'] = Json::encode($this->cancel_at_period_end);
        $data['canceled_at'] = Json::encode($this->canceled_at);
        $data['started_at'] = Json::encode($this->started_at);
        $data['ends_at'] = Json::encode($this->ends_at);
        $data['ended_at'] = Json::encode($this->ended_at);
        $data['pause_at_period_end'] = Json::encode($this->pause_at_period_end);
        $data['paused_at'] = Json::encode($this->paused_at);
        $data['resumes_at'] = Json::encode($this->resumes_at);
        $data['customer_id'] = Json::encode($this->customer_id);
        $data['product_id'] = Json::encode($this->product_id);
        $data['discount_id'] = Json::encode($this->discount_id);
        $data['checkout_id'] = Json::encode($this->checkout_id);
        $data['customer_cancellation_reason'] = Json::encode($this->customer_cancellation_reason);
        $data['customer_cancellation_comment'] = Json::encode($this->customer_cancellation_comment);
        if ($this->past_due_at !== null) {
            $data['past_due_at'] = Json::encode($this->past_due_at);
        }
        if ($this->seats !== null) {
            $data['seats'] = Json::encode($this->seats);
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