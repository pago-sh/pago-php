<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Sent when a customer seat is revoked.
 *
 * This event is triggered when access to a seat is revoked, either manually by the organization or automatically when a subscription is canceled.
 */
final class WebhookCustomerSeatRevokedPayload implements Model, Deserializable, WebhookPayload
{
    public function __construct(
        public readonly string $type,
        public readonly string $timestamp,
        public readonly CustomerSeat $data,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $type = Json::toString(Json::get($data, 'type'));
        $timestamp = Json::toString(Json::get($data, 'timestamp'));
        $data = CustomerSeat::fromArray(Json::toMap(Json::get($data, 'data')));

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