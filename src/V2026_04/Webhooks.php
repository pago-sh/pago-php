<?php

declare(strict_types=1);

namespace Pago\V2026_04;

use Pago\Exception\PagoWebhookUnknownTypeException;
use Pago\Serialization\Json;
use Pago\Webhook\WebhookVerifier;
use Pago\V2026_04\Models\WebhookPayload;

/**
 * Webhook signature verification and payload deserialization for version
 * 2026-04 of the Pago API.
 */
final class Webhooks
{
    /**
     * Every event type this SDK version understands, mapped to its payload
     * class. Deliberately left un-annotated so that static analysis infers the
     * exact class-string union from the literal.
     */
    private const PAYLOAD_TYPES = [
        'benefit.created' => \Pago\V2026_04\Models\WebhookBenefitCreatedPayload::class,
        'benefit.updated' => \Pago\V2026_04\Models\WebhookBenefitUpdatedPayload::class,
        'benefit_grant.created' => \Pago\V2026_04\Models\WebhookBenefitGrantCreatedPayload::class,
        'benefit_grant.cycled' => \Pago\V2026_04\Models\WebhookBenefitGrantCycledPayload::class,
        'benefit_grant.revoked' => \Pago\V2026_04\Models\WebhookBenefitGrantRevokedPayload::class,
        'benefit_grant.updated' => \Pago\V2026_04\Models\WebhookBenefitGrantUpdatedPayload::class,
        'checkout.created' => \Pago\V2026_04\Models\WebhookCheckoutCreatedPayload::class,
        'checkout.expired' => \Pago\V2026_04\Models\WebhookCheckoutExpiredPayload::class,
        'checkout.updated' => \Pago\V2026_04\Models\WebhookCheckoutUpdatedPayload::class,
        'customer.created' => \Pago\V2026_04\Models\WebhookCustomerCreatedPayload::class,
        'customer.deleted' => \Pago\V2026_04\Models\WebhookCustomerDeletedPayload::class,
        'customer.state_changed' => \Pago\V2026_04\Models\WebhookCustomerStateChangedPayload::class,
        'customer.updated' => \Pago\V2026_04\Models\WebhookCustomerUpdatedPayload::class,
        'customer_seat.assigned' => \Pago\V2026_04\Models\WebhookCustomerSeatAssignedPayload::class,
        'customer_seat.claimed' => \Pago\V2026_04\Models\WebhookCustomerSeatClaimedPayload::class,
        'customer_seat.revoked' => \Pago\V2026_04\Models\WebhookCustomerSeatRevokedPayload::class,
        'member.created' => \Pago\V2026_04\Models\WebhookMemberCreatedPayload::class,
        'member.deleted' => \Pago\V2026_04\Models\WebhookMemberDeletedPayload::class,
        'member.updated' => \Pago\V2026_04\Models\WebhookMemberUpdatedPayload::class,
        'order.created' => \Pago\V2026_04\Models\WebhookOrderCreatedPayload::class,
        'order.paid' => \Pago\V2026_04\Models\WebhookOrderPaidPayload::class,
        'order.refunded' => \Pago\V2026_04\Models\WebhookOrderRefundedPayload::class,
        'order.updated' => \Pago\V2026_04\Models\WebhookOrderUpdatedPayload::class,
        'organization.updated' => \Pago\V2026_04\Models\WebhookOrganizationUpdatedPayload::class,
        'product.created' => \Pago\V2026_04\Models\WebhookProductCreatedPayload::class,
        'product.updated' => \Pago\V2026_04\Models\WebhookProductUpdatedPayload::class,
        'refund.created' => \Pago\V2026_04\Models\WebhookRefundCreatedPayload::class,
        'refund.updated' => \Pago\V2026_04\Models\WebhookRefundUpdatedPayload::class,
        'subscription.active' => \Pago\V2026_04\Models\WebhookSubscriptionActivePayload::class,
        'subscription.canceled' => \Pago\V2026_04\Models\WebhookSubscriptionCanceledPayload::class,
        'subscription.created' => \Pago\V2026_04\Models\WebhookSubscriptionCreatedPayload::class,
        'subscription.past_due' => \Pago\V2026_04\Models\WebhookSubscriptionPastDuePayload::class,
        'subscription.paused' => \Pago\V2026_04\Models\WebhookSubscriptionPausedPayload::class,
        'subscription.resumed' => \Pago\V2026_04\Models\WebhookSubscriptionResumedPayload::class,
        'subscription.revoked' => \Pago\V2026_04\Models\WebhookSubscriptionRevokedPayload::class,
        'subscription.uncanceled' => \Pago\V2026_04\Models\WebhookSubscriptionUncanceledPayload::class,
        'subscription.updated' => \Pago\V2026_04\Models\WebhookSubscriptionUpdatedPayload::class,
    ];

    /**
     * Verify a raw Pago webhook request and deserialize its typed payload.
     *
     * @param string                $body    the raw request body, byte for byte
     * @param array<string, string> $headers the request headers, case-insensitive
     * @param string                $secret  the endpoint signing secret
     *
     * @throws \Pago\Exception\PagoWebhookVerificationException when the signature does not verify
     * @throws PagoWebhookUnknownTypeException                  when the event type is unknown to this SDK version
     * @throws \Pago\Exception\PagoSerializationException       when the payload does not match its schema
     */
    public static function validateEvent(string $body, array $headers, string $secret): WebhookPayload
    {
        WebhookVerifier::verify($body, $headers, $secret);

        $data = Json::toMap(Json::decode($body));
        $eventType = $data['type'] ?? null;

        if (!is_string($eventType) || !isset(self::PAYLOAD_TYPES[$eventType])) {
            throw new PagoWebhookUnknownTypeException(
                is_string($eventType) ? $eventType : null,
            );
        }

        return self::PAYLOAD_TYPES[$eventType]::fromArray($data);
    }

    /**
     * @return list<string>
     */
    public static function eventTypes(): array
    {
        return array_keys(self::PAYLOAD_TYPES);
    }
}