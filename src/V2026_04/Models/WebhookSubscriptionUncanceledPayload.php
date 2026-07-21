<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Sent when a customer revokes a pending cancellation.
 *
 * When a customer cancels with "at period end", they retain access until the
 * subscription would renew. During this time, they can change their mind and
 * undo the cancellation. This event is triggered when they do so.
 *
 * **Discord & Slack support:** Full
 */
final class WebhookSubscriptionUncanceledPayload implements Model, Deserializable, WebhookPayload
{
    public function __construct(
        public readonly string $type,
        public readonly string $timestamp,
        public readonly Subscription $data,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $type = Json::toString(Json::get($data, 'type'));
        $timestamp = Json::toString(Json::get($data, 'timestamp'));
        $data = Subscription::fromArray(Json::toMap(Json::get($data, 'data')));

        return new self(
            type: $type,
            timestamp: $timestamp,
            data: $data,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['type'] = Json::encode($this->type);
        $data['timestamp'] = Json::encode($this->timestamp);
        $data['data'] = Json::encode($this->data);

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