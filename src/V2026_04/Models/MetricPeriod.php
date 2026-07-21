<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * MetricPeriod
 */
final class MetricPeriod implements Model, Deserializable
{
    public function __construct(
        public readonly string $timestamp,
        public readonly int|float|null $active_subscriptions = null,
        public readonly int|float|null $committed_subscriptions = null,
        public readonly int|float|null $monthly_recurring_revenue = null,
        public readonly int|float|null $trial_monthly_recurring_revenue = null,
        public readonly int|float|null $committed_monthly_recurring_revenue = null,
        public readonly int|float|null $trial_committed_monthly_recurring_revenue = null,
        public readonly int|float|null $average_revenue_per_user = null,
        public readonly int|float|null $checkouts = null,
        public readonly int|float|null $succeeded_checkouts = null,
        public readonly int|float|null $churned_subscriptions = null,
        public readonly int|float|null $churn_rate = null,
        public readonly int|float|null $seats_total = null,
        public readonly int|float|null $seats_claimed = null,
        public readonly int|float|null $seats_pending = null,
        public readonly int|float|null $seat_customers = null,
        public readonly int|float|null $new_seat_customers = null,
        public readonly int|float|null $churned_seat_customers = null,
        public readonly int|float|null $orders = null,
        public readonly int|float|null $revenue = null,
        public readonly int|float|null $net_revenue = null,
        public readonly int|float|null $cumulative_revenue = null,
        public readonly int|float|null $net_cumulative_revenue = null,
        public readonly int|float|null $costs = null,
        public readonly int|float|null $cumulative_costs = null,
        public readonly int|float|null $average_order_value = null,
        public readonly int|float|null $net_average_order_value = null,
        public readonly int|float|null $cost_per_user = null,
        public readonly int|float|null $active_user_by_event = null,
        public readonly int|float|null $one_time_products = null,
        public readonly int|float|null $one_time_products_revenue = null,
        public readonly int|float|null $one_time_products_net_revenue = null,
        public readonly int|float|null $new_subscriptions = null,
        public readonly int|float|null $new_subscriptions_revenue = null,
        public readonly int|float|null $new_subscriptions_net_revenue = null,
        public readonly int|float|null $renewed_subscriptions = null,
        public readonly int|float|null $renewed_subscriptions_revenue = null,
        public readonly int|float|null $renewed_subscriptions_net_revenue = null,
        public readonly int|float|null $canceled_subscriptions = null,
        public readonly int|float|null $canceled_subscriptions_customer_service = null,
        public readonly int|float|null $canceled_subscriptions_low_quality = null,
        public readonly int|float|null $canceled_subscriptions_missing_features = null,
        public readonly int|float|null $canceled_subscriptions_switched_service = null,
        public readonly int|float|null $canceled_subscriptions_too_complex = null,
        public readonly int|float|null $canceled_subscriptions_too_expensive = null,
        public readonly int|float|null $canceled_subscriptions_unused = null,
        public readonly int|float|null $canceled_subscriptions_other = null,
        public readonly int|float|null $annual_recurring_revenue = null,
        public readonly int|float|null $committed_annual_recurring_revenue = null,
        public readonly int|float|null $checkouts_conversion = null,
        public readonly int|float|null $ltv = null,
        public readonly int|float|null $gross_margin = null,
        public readonly int|float|null $gross_margin_percentage = null,
        public readonly int|float|null $cashflow = null,
        public readonly int|float|null $average_seats_per_customer = null,
        public readonly int|float|null $seat_utilization_rate = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $timestamp = Json::toString(Json::get($data, 'timestamp'));
        /** @var int|float|null $active_subscriptions */
        $active_subscriptions = isset($data['active_subscriptions']) ? $data['active_subscriptions'] : null;
        /** @var int|float|null $committed_subscriptions */
        $committed_subscriptions = isset($data['committed_subscriptions']) ? $data['committed_subscriptions'] : null;
        /** @var int|float|null $monthly_recurring_revenue */
        $monthly_recurring_revenue = isset($data['monthly_recurring_revenue']) ? $data['monthly_recurring_revenue'] : null;
        /** @var int|float|null $trial_monthly_recurring_revenue */
        $trial_monthly_recurring_revenue = isset($data['trial_monthly_recurring_revenue']) ? $data['trial_monthly_recurring_revenue'] : null;
        /** @var int|float|null $committed_monthly_recurring_revenue */
        $committed_monthly_recurring_revenue = isset($data['committed_monthly_recurring_revenue']) ? $data['committed_monthly_recurring_revenue'] : null;
        /** @var int|float|null $trial_committed_monthly_recurring_revenue */
        $trial_committed_monthly_recurring_revenue = isset($data['trial_committed_monthly_recurring_revenue']) ? $data['trial_committed_monthly_recurring_revenue'] : null;
        /** @var int|float|null $average_revenue_per_user */
        $average_revenue_per_user = isset($data['average_revenue_per_user']) ? $data['average_revenue_per_user'] : null;
        /** @var int|float|null $checkouts */
        $checkouts = isset($data['checkouts']) ? $data['checkouts'] : null;
        /** @var int|float|null $succeeded_checkouts */
        $succeeded_checkouts = isset($data['succeeded_checkouts']) ? $data['succeeded_checkouts'] : null;
        /** @var int|float|null $churned_subscriptions */
        $churned_subscriptions = isset($data['churned_subscriptions']) ? $data['churned_subscriptions'] : null;
        /** @var int|float|null $churn_rate */
        $churn_rate = isset($data['churn_rate']) ? $data['churn_rate'] : null;
        /** @var int|float|null $seats_total */
        $seats_total = isset($data['seats_total']) ? $data['seats_total'] : null;
        /** @var int|float|null $seats_claimed */
        $seats_claimed = isset($data['seats_claimed']) ? $data['seats_claimed'] : null;
        /** @var int|float|null $seats_pending */
        $seats_pending = isset($data['seats_pending']) ? $data['seats_pending'] : null;
        /** @var int|float|null $seat_customers */
        $seat_customers = isset($data['seat_customers']) ? $data['seat_customers'] : null;
        /** @var int|float|null $new_seat_customers */
        $new_seat_customers = isset($data['new_seat_customers']) ? $data['new_seat_customers'] : null;
        /** @var int|float|null $churned_seat_customers */
        $churned_seat_customers = isset($data['churned_seat_customers']) ? $data['churned_seat_customers'] : null;
        /** @var int|float|null $orders */
        $orders = isset($data['orders']) ? $data['orders'] : null;
        /** @var int|float|null $revenue */
        $revenue = isset($data['revenue']) ? $data['revenue'] : null;
        /** @var int|float|null $net_revenue */
        $net_revenue = isset($data['net_revenue']) ? $data['net_revenue'] : null;
        /** @var int|float|null $cumulative_revenue */
        $cumulative_revenue = isset($data['cumulative_revenue']) ? $data['cumulative_revenue'] : null;
        /** @var int|float|null $net_cumulative_revenue */
        $net_cumulative_revenue = isset($data['net_cumulative_revenue']) ? $data['net_cumulative_revenue'] : null;
        /** @var int|float|null $costs */
        $costs = isset($data['costs']) ? $data['costs'] : null;
        /** @var int|float|null $cumulative_costs */
        $cumulative_costs = isset($data['cumulative_costs']) ? $data['cumulative_costs'] : null;
        /** @var int|float|null $average_order_value */
        $average_order_value = isset($data['average_order_value']) ? $data['average_order_value'] : null;
        /** @var int|float|null $net_average_order_value */
        $net_average_order_value = isset($data['net_average_order_value']) ? $data['net_average_order_value'] : null;
        /** @var int|float|null $cost_per_user */
        $cost_per_user = isset($data['cost_per_user']) ? $data['cost_per_user'] : null;
        /** @var int|float|null $active_user_by_event */
        $active_user_by_event = isset($data['active_user_by_event']) ? $data['active_user_by_event'] : null;
        /** @var int|float|null $one_time_products */
        $one_time_products = isset($data['one_time_products']) ? $data['one_time_products'] : null;
        /** @var int|float|null $one_time_products_revenue */
        $one_time_products_revenue = isset($data['one_time_products_revenue']) ? $data['one_time_products_revenue'] : null;
        /** @var int|float|null $one_time_products_net_revenue */
        $one_time_products_net_revenue = isset($data['one_time_products_net_revenue']) ? $data['one_time_products_net_revenue'] : null;
        /** @var int|float|null $new_subscriptions */
        $new_subscriptions = isset($data['new_subscriptions']) ? $data['new_subscriptions'] : null;
        /** @var int|float|null $new_subscriptions_revenue */
        $new_subscriptions_revenue = isset($data['new_subscriptions_revenue']) ? $data['new_subscriptions_revenue'] : null;
        /** @var int|float|null $new_subscriptions_net_revenue */
        $new_subscriptions_net_revenue = isset($data['new_subscriptions_net_revenue']) ? $data['new_subscriptions_net_revenue'] : null;
        /** @var int|float|null $renewed_subscriptions */
        $renewed_subscriptions = isset($data['renewed_subscriptions']) ? $data['renewed_subscriptions'] : null;
        /** @var int|float|null $renewed_subscriptions_revenue */
        $renewed_subscriptions_revenue = isset($data['renewed_subscriptions_revenue']) ? $data['renewed_subscriptions_revenue'] : null;
        /** @var int|float|null $renewed_subscriptions_net_revenue */
        $renewed_subscriptions_net_revenue = isset($data['renewed_subscriptions_net_revenue']) ? $data['renewed_subscriptions_net_revenue'] : null;
        /** @var int|float|null $canceled_subscriptions */
        $canceled_subscriptions = isset($data['canceled_subscriptions']) ? $data['canceled_subscriptions'] : null;
        /** @var int|float|null $canceled_subscriptions_customer_service */
        $canceled_subscriptions_customer_service = isset($data['canceled_subscriptions_customer_service']) ? $data['canceled_subscriptions_customer_service'] : null;
        /** @var int|float|null $canceled_subscriptions_low_quality */
        $canceled_subscriptions_low_quality = isset($data['canceled_subscriptions_low_quality']) ? $data['canceled_subscriptions_low_quality'] : null;
        /** @var int|float|null $canceled_subscriptions_missing_features */
        $canceled_subscriptions_missing_features = isset($data['canceled_subscriptions_missing_features']) ? $data['canceled_subscriptions_missing_features'] : null;
        /** @var int|float|null $canceled_subscriptions_switched_service */
        $canceled_subscriptions_switched_service = isset($data['canceled_subscriptions_switched_service']) ? $data['canceled_subscriptions_switched_service'] : null;
        /** @var int|float|null $canceled_subscriptions_too_complex */
        $canceled_subscriptions_too_complex = isset($data['canceled_subscriptions_too_complex']) ? $data['canceled_subscriptions_too_complex'] : null;
        /** @var int|float|null $canceled_subscriptions_too_expensive */
        $canceled_subscriptions_too_expensive = isset($data['canceled_subscriptions_too_expensive']) ? $data['canceled_subscriptions_too_expensive'] : null;
        /** @var int|float|null $canceled_subscriptions_unused */
        $canceled_subscriptions_unused = isset($data['canceled_subscriptions_unused']) ? $data['canceled_subscriptions_unused'] : null;
        /** @var int|float|null $canceled_subscriptions_other */
        $canceled_subscriptions_other = isset($data['canceled_subscriptions_other']) ? $data['canceled_subscriptions_other'] : null;
        /** @var int|float|null $annual_recurring_revenue */
        $annual_recurring_revenue = isset($data['annual_recurring_revenue']) ? $data['annual_recurring_revenue'] : null;
        /** @var int|float|null $committed_annual_recurring_revenue */
        $committed_annual_recurring_revenue = isset($data['committed_annual_recurring_revenue']) ? $data['committed_annual_recurring_revenue'] : null;
        /** @var int|float|null $checkouts_conversion */
        $checkouts_conversion = isset($data['checkouts_conversion']) ? $data['checkouts_conversion'] : null;
        /** @var int|float|null $ltv */
        $ltv = isset($data['ltv']) ? $data['ltv'] : null;
        /** @var int|float|null $gross_margin */
        $gross_margin = isset($data['gross_margin']) ? $data['gross_margin'] : null;
        /** @var int|float|null $gross_margin_percentage */
        $gross_margin_percentage = isset($data['gross_margin_percentage']) ? $data['gross_margin_percentage'] : null;
        /** @var int|float|null $cashflow */
        $cashflow = isset($data['cashflow']) ? $data['cashflow'] : null;
        /** @var int|float|null $average_seats_per_customer */
        $average_seats_per_customer = isset($data['average_seats_per_customer']) ? $data['average_seats_per_customer'] : null;
        /** @var int|float|null $seat_utilization_rate */
        $seat_utilization_rate = isset($data['seat_utilization_rate']) ? $data['seat_utilization_rate'] : null;

        return new self(
            timestamp: $timestamp,
            active_subscriptions: $active_subscriptions,
            committed_subscriptions: $committed_subscriptions,
            monthly_recurring_revenue: $monthly_recurring_revenue,
            trial_monthly_recurring_revenue: $trial_monthly_recurring_revenue,
            committed_monthly_recurring_revenue: $committed_monthly_recurring_revenue,
            trial_committed_monthly_recurring_revenue: $trial_committed_monthly_recurring_revenue,
            average_revenue_per_user: $average_revenue_per_user,
            checkouts: $checkouts,
            succeeded_checkouts: $succeeded_checkouts,
            churned_subscriptions: $churned_subscriptions,
            churn_rate: $churn_rate,
            seats_total: $seats_total,
            seats_claimed: $seats_claimed,
            seats_pending: $seats_pending,
            seat_customers: $seat_customers,
            new_seat_customers: $new_seat_customers,
            churned_seat_customers: $churned_seat_customers,
            orders: $orders,
            revenue: $revenue,
            net_revenue: $net_revenue,
            cumulative_revenue: $cumulative_revenue,
            net_cumulative_revenue: $net_cumulative_revenue,
            costs: $costs,
            cumulative_costs: $cumulative_costs,
            average_order_value: $average_order_value,
            net_average_order_value: $net_average_order_value,
            cost_per_user: $cost_per_user,
            active_user_by_event: $active_user_by_event,
            one_time_products: $one_time_products,
            one_time_products_revenue: $one_time_products_revenue,
            one_time_products_net_revenue: $one_time_products_net_revenue,
            new_subscriptions: $new_subscriptions,
            new_subscriptions_revenue: $new_subscriptions_revenue,
            new_subscriptions_net_revenue: $new_subscriptions_net_revenue,
            renewed_subscriptions: $renewed_subscriptions,
            renewed_subscriptions_revenue: $renewed_subscriptions_revenue,
            renewed_subscriptions_net_revenue: $renewed_subscriptions_net_revenue,
            canceled_subscriptions: $canceled_subscriptions,
            canceled_subscriptions_customer_service: $canceled_subscriptions_customer_service,
            canceled_subscriptions_low_quality: $canceled_subscriptions_low_quality,
            canceled_subscriptions_missing_features: $canceled_subscriptions_missing_features,
            canceled_subscriptions_switched_service: $canceled_subscriptions_switched_service,
            canceled_subscriptions_too_complex: $canceled_subscriptions_too_complex,
            canceled_subscriptions_too_expensive: $canceled_subscriptions_too_expensive,
            canceled_subscriptions_unused: $canceled_subscriptions_unused,
            canceled_subscriptions_other: $canceled_subscriptions_other,
            annual_recurring_revenue: $annual_recurring_revenue,
            committed_annual_recurring_revenue: $committed_annual_recurring_revenue,
            checkouts_conversion: $checkouts_conversion,
            ltv: $ltv,
            gross_margin: $gross_margin,
            gross_margin_percentage: $gross_margin_percentage,
            cashflow: $cashflow,
            average_seats_per_customer: $average_seats_per_customer,
            seat_utilization_rate: $seat_utilization_rate,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['timestamp'] = Json::encode($this->timestamp);
        if ($this->active_subscriptions !== null) {
            $data['active_subscriptions'] = Json::encode($this->active_subscriptions);
        }
        if ($this->committed_subscriptions !== null) {
            $data['committed_subscriptions'] = Json::encode($this->committed_subscriptions);
        }
        if ($this->monthly_recurring_revenue !== null) {
            $data['monthly_recurring_revenue'] = Json::encode($this->monthly_recurring_revenue);
        }
        if ($this->trial_monthly_recurring_revenue !== null) {
            $data['trial_monthly_recurring_revenue'] = Json::encode($this->trial_monthly_recurring_revenue);
        }
        if ($this->committed_monthly_recurring_revenue !== null) {
            $data['committed_monthly_recurring_revenue'] = Json::encode($this->committed_monthly_recurring_revenue);
        }
        if ($this->trial_committed_monthly_recurring_revenue !== null) {
            $data['trial_committed_monthly_recurring_revenue'] = Json::encode($this->trial_committed_monthly_recurring_revenue);
        }
        if ($this->average_revenue_per_user !== null) {
            $data['average_revenue_per_user'] = Json::encode($this->average_revenue_per_user);
        }
        if ($this->checkouts !== null) {
            $data['checkouts'] = Json::encode($this->checkouts);
        }
        if ($this->succeeded_checkouts !== null) {
            $data['succeeded_checkouts'] = Json::encode($this->succeeded_checkouts);
        }
        if ($this->churned_subscriptions !== null) {
            $data['churned_subscriptions'] = Json::encode($this->churned_subscriptions);
        }
        if ($this->churn_rate !== null) {
            $data['churn_rate'] = Json::encode($this->churn_rate);
        }
        if ($this->seats_total !== null) {
            $data['seats_total'] = Json::encode($this->seats_total);
        }
        if ($this->seats_claimed !== null) {
            $data['seats_claimed'] = Json::encode($this->seats_claimed);
        }
        if ($this->seats_pending !== null) {
            $data['seats_pending'] = Json::encode($this->seats_pending);
        }
        if ($this->seat_customers !== null) {
            $data['seat_customers'] = Json::encode($this->seat_customers);
        }
        if ($this->new_seat_customers !== null) {
            $data['new_seat_customers'] = Json::encode($this->new_seat_customers);
        }
        if ($this->churned_seat_customers !== null) {
            $data['churned_seat_customers'] = Json::encode($this->churned_seat_customers);
        }
        if ($this->orders !== null) {
            $data['orders'] = Json::encode($this->orders);
        }
        if ($this->revenue !== null) {
            $data['revenue'] = Json::encode($this->revenue);
        }
        if ($this->net_revenue !== null) {
            $data['net_revenue'] = Json::encode($this->net_revenue);
        }
        if ($this->cumulative_revenue !== null) {
            $data['cumulative_revenue'] = Json::encode($this->cumulative_revenue);
        }
        if ($this->net_cumulative_revenue !== null) {
            $data['net_cumulative_revenue'] = Json::encode($this->net_cumulative_revenue);
        }
        if ($this->costs !== null) {
            $data['costs'] = Json::encode($this->costs);
        }
        if ($this->cumulative_costs !== null) {
            $data['cumulative_costs'] = Json::encode($this->cumulative_costs);
        }
        if ($this->average_order_value !== null) {
            $data['average_order_value'] = Json::encode($this->average_order_value);
        }
        if ($this->net_average_order_value !== null) {
            $data['net_average_order_value'] = Json::encode($this->net_average_order_value);
        }
        if ($this->cost_per_user !== null) {
            $data['cost_per_user'] = Json::encode($this->cost_per_user);
        }
        if ($this->active_user_by_event !== null) {
            $data['active_user_by_event'] = Json::encode($this->active_user_by_event);
        }
        if ($this->one_time_products !== null) {
            $data['one_time_products'] = Json::encode($this->one_time_products);
        }
        if ($this->one_time_products_revenue !== null) {
            $data['one_time_products_revenue'] = Json::encode($this->one_time_products_revenue);
        }
        if ($this->one_time_products_net_revenue !== null) {
            $data['one_time_products_net_revenue'] = Json::encode($this->one_time_products_net_revenue);
        }
        if ($this->new_subscriptions !== null) {
            $data['new_subscriptions'] = Json::encode($this->new_subscriptions);
        }
        if ($this->new_subscriptions_revenue !== null) {
            $data['new_subscriptions_revenue'] = Json::encode($this->new_subscriptions_revenue);
        }
        if ($this->new_subscriptions_net_revenue !== null) {
            $data['new_subscriptions_net_revenue'] = Json::encode($this->new_subscriptions_net_revenue);
        }
        if ($this->renewed_subscriptions !== null) {
            $data['renewed_subscriptions'] = Json::encode($this->renewed_subscriptions);
        }
        if ($this->renewed_subscriptions_revenue !== null) {
            $data['renewed_subscriptions_revenue'] = Json::encode($this->renewed_subscriptions_revenue);
        }
        if ($this->renewed_subscriptions_net_revenue !== null) {
            $data['renewed_subscriptions_net_revenue'] = Json::encode($this->renewed_subscriptions_net_revenue);
        }
        if ($this->canceled_subscriptions !== null) {
            $data['canceled_subscriptions'] = Json::encode($this->canceled_subscriptions);
        }
        if ($this->canceled_subscriptions_customer_service !== null) {
            $data['canceled_subscriptions_customer_service'] = Json::encode($this->canceled_subscriptions_customer_service);
        }
        if ($this->canceled_subscriptions_low_quality !== null) {
            $data['canceled_subscriptions_low_quality'] = Json::encode($this->canceled_subscriptions_low_quality);
        }
        if ($this->canceled_subscriptions_missing_features !== null) {
            $data['canceled_subscriptions_missing_features'] = Json::encode($this->canceled_subscriptions_missing_features);
        }
        if ($this->canceled_subscriptions_switched_service !== null) {
            $data['canceled_subscriptions_switched_service'] = Json::encode($this->canceled_subscriptions_switched_service);
        }
        if ($this->canceled_subscriptions_too_complex !== null) {
            $data['canceled_subscriptions_too_complex'] = Json::encode($this->canceled_subscriptions_too_complex);
        }
        if ($this->canceled_subscriptions_too_expensive !== null) {
            $data['canceled_subscriptions_too_expensive'] = Json::encode($this->canceled_subscriptions_too_expensive);
        }
        if ($this->canceled_subscriptions_unused !== null) {
            $data['canceled_subscriptions_unused'] = Json::encode($this->canceled_subscriptions_unused);
        }
        if ($this->canceled_subscriptions_other !== null) {
            $data['canceled_subscriptions_other'] = Json::encode($this->canceled_subscriptions_other);
        }
        if ($this->annual_recurring_revenue !== null) {
            $data['annual_recurring_revenue'] = Json::encode($this->annual_recurring_revenue);
        }
        if ($this->committed_annual_recurring_revenue !== null) {
            $data['committed_annual_recurring_revenue'] = Json::encode($this->committed_annual_recurring_revenue);
        }
        if ($this->checkouts_conversion !== null) {
            $data['checkouts_conversion'] = Json::encode($this->checkouts_conversion);
        }
        if ($this->ltv !== null) {
            $data['ltv'] = Json::encode($this->ltv);
        }
        if ($this->gross_margin !== null) {
            $data['gross_margin'] = Json::encode($this->gross_margin);
        }
        if ($this->gross_margin_percentage !== null) {
            $data['gross_margin_percentage'] = Json::encode($this->gross_margin_percentage);
        }
        if ($this->cashflow !== null) {
            $data['cashflow'] = Json::encode($this->cashflow);
        }
        if ($this->average_seats_per_customer !== null) {
            $data['average_seats_per_customer'] = Json::encode($this->average_seats_per_customer);
        }
        if ($this->seat_utilization_rate !== null) {
            $data['seat_utilization_rate'] = Json::encode($this->seat_utilization_rate);
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