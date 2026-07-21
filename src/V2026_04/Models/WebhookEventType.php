<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * WebhookEventType
 */
enum WebhookEventType: string
{
    case CHECKOUT_CREATED = 'checkout.created';
    case CHECKOUT_UPDATED = 'checkout.updated';
    case CHECKOUT_EXPIRED = 'checkout.expired';
    case CUSTOMER_CREATED = 'customer.created';
    case CUSTOMER_UPDATED = 'customer.updated';
    case CUSTOMER_DELETED = 'customer.deleted';
    case CUSTOMER_STATE_CHANGED = 'customer.state_changed';
    case CUSTOMER_SEAT_ASSIGNED = 'customer_seat.assigned';
    case CUSTOMER_SEAT_CLAIMED = 'customer_seat.claimed';
    case CUSTOMER_SEAT_REVOKED = 'customer_seat.revoked';
    case MEMBER_CREATED = 'member.created';
    case MEMBER_UPDATED = 'member.updated';
    case MEMBER_DELETED = 'member.deleted';
    case ORDER_CREATED = 'order.created';
    case ORDER_UPDATED = 'order.updated';
    case ORDER_PAID = 'order.paid';
    case ORDER_REFUNDED = 'order.refunded';
    case SUBSCRIPTION_CREATED = 'subscription.created';
    case SUBSCRIPTION_UPDATED = 'subscription.updated';
    case SUBSCRIPTION_ACTIVE = 'subscription.active';
    case SUBSCRIPTION_CANCELED = 'subscription.canceled';
    case SUBSCRIPTION_UNCANCELED = 'subscription.uncanceled';
    case SUBSCRIPTION_REVOKED = 'subscription.revoked';
    case SUBSCRIPTION_PAST_DUE = 'subscription.past_due';
    case SUBSCRIPTION_PAUSED = 'subscription.paused';
    case SUBSCRIPTION_RESUMED = 'subscription.resumed';
    case REFUND_CREATED = 'refund.created';
    case REFUND_UPDATED = 'refund.updated';
    case PRODUCT_CREATED = 'product.created';
    case PRODUCT_UPDATED = 'product.updated';
    case BENEFIT_CREATED = 'benefit.created';
    case BENEFIT_UPDATED = 'benefit.updated';
    case BENEFIT_GRANT_CREATED = 'benefit_grant.created';
    case BENEFIT_GRANT_CYCLED = 'benefit_grant.cycled';
    case BENEFIT_GRANT_UPDATED = 'benefit_grant.updated';
    case BENEFIT_GRANT_REVOKED = 'benefit_grant.revoked';
    case ORGANIZATION_UPDATED = 'organization.updated';
}