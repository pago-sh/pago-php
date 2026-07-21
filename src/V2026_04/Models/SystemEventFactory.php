<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see SystemEvent} variant for a payload.
 *
 * Dispatch is driven by the `name` discriminator property.
 */
final class SystemEventFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): SystemEvent
    {
        $resolved = Union::resolve($data, 'name', ['balance.credit_order' => BalanceCreditOrderEvent::class, 'balance.dispute' => BalanceDisputeEvent::class, 'balance.dispute_reversal' => BalanceDisputeReversalEvent::class, 'balance.order' => BalanceOrderEvent::class, 'balance.refund' => BalanceRefundEvent::class, 'balance.refund_reversal' => BalanceRefundReversalEvent::class, 'benefit.cycled' => BenefitCycledEvent::class, 'benefit.granted' => BenefitGrantedEvent::class, 'benefit.revoked' => BenefitRevokedEvent::class, 'benefit.updated' => BenefitUpdatedEvent::class, 'checkout.created' => CheckoutCreatedEvent::class, 'customer.created' => CustomerCreatedEvent::class, 'customer.deleted' => CustomerDeletedEvent::class, 'customer.updated' => CustomerUpdatedEvent::class, 'meter.credited' => MeterCreditEvent::class, 'meter.reset' => MeterResetEvent::class, 'order.paid' => OrderPaidEvent::class, 'order.refunded' => OrderRefundedEvent::class, 'order.voided' => OrderVoidedEvent::class, 'subscription.billing_period_updated' => SubscriptionBillingPeriodUpdatedEvent::class, 'subscription.canceled' => SubscriptionCanceledEvent::class, 'subscription.created' => SubscriptionCreatedEvent::class, 'subscription.cycled' => SubscriptionCycledEvent::class, 'subscription.past_due' => SubscriptionPastDueEvent::class, 'subscription.paused' => SubscriptionPausedEvent::class, 'subscription.product_updated' => SubscriptionProductUpdatedEvent::class, 'subscription.reactivated' => SubscriptionReactivatedEvent::class, 'subscription.resumed' => SubscriptionResumedEvent::class, 'subscription.revoked' => SubscriptionRevokedEvent::class, 'subscription.seats_updated' => SubscriptionSeatsUpdatedEvent::class, 'subscription.uncanceled' => SubscriptionUncanceledEvent::class, 'subscription.update_cleared' => SubscriptionUpdateClearedEvent::class, 'subscription.updated' => SubscriptionUpdatedEvent::class], [MeterCreditEvent::class, MeterResetEvent::class, BenefitGrantedEvent::class, BenefitCycledEvent::class, BenefitUpdatedEvent::class, BenefitRevokedEvent::class, SubscriptionCreatedEvent::class, SubscriptionUpdatedEvent::class, SubscriptionCycledEvent::class, SubscriptionCanceledEvent::class, SubscriptionRevokedEvent::class, SubscriptionPastDueEvent::class, SubscriptionReactivatedEvent::class, SubscriptionPausedEvent::class, SubscriptionResumedEvent::class, SubscriptionUncanceledEvent::class, SubscriptionProductUpdatedEvent::class, SubscriptionSeatsUpdatedEvent::class, SubscriptionBillingPeriodUpdatedEvent::class, SubscriptionUpdateClearedEvent::class, OrderPaidEvent::class, OrderRefundedEvent::class, OrderVoidedEvent::class, CheckoutCreatedEvent::class, CustomerCreatedEvent::class, CustomerUpdatedEvent::class, CustomerDeletedEvent::class, BalanceOrderEvent::class, BalanceCreditOrderEvent::class, BalanceRefundEvent::class, BalanceRefundReversalEvent::class, BalanceDisputeEvent::class, BalanceDisputeReversalEvent::class]);

        if (!$resolved instanceof SystemEvent) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any SystemEvent variant.',
            );
        }

        return $resolved;
    }
}