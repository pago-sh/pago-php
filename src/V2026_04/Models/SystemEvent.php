<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;


/**
 * SystemEvent
 *
 * Implemented by every variant of this union:
 * - MeterCreditEvent
 * - MeterResetEvent
 * - BenefitGrantedEvent
 * - BenefitCycledEvent
 * - BenefitUpdatedEvent
 * - BenefitRevokedEvent
 * - SubscriptionCreatedEvent
 * - SubscriptionUpdatedEvent
 * - SubscriptionCycledEvent
 * - SubscriptionCanceledEvent
 * - SubscriptionRevokedEvent
 * - SubscriptionPastDueEvent
 * - SubscriptionReactivatedEvent
 * - SubscriptionPausedEvent
 * - SubscriptionResumedEvent
 * - SubscriptionUncanceledEvent
 * - SubscriptionProductUpdatedEvent
 * - SubscriptionSeatsUpdatedEvent
 * - SubscriptionBillingPeriodUpdatedEvent
 * - SubscriptionUpdateClearedEvent
 * - OrderPaidEvent
 * - OrderRefundedEvent
 * - OrderVoidedEvent
 * - CheckoutCreatedEvent
 * - CustomerCreatedEvent
 * - CustomerUpdatedEvent
 * - CustomerDeletedEvent
 * - BalanceOrderEvent
 * - BalanceCreditOrderEvent
 * - BalanceRefundEvent
 * - BalanceRefundReversalEvent
 * - BalanceDisputeEvent
 * - BalanceDisputeReversalEvent
 *
 * Use {@see SystemEventFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface SystemEvent extends Event
{
}