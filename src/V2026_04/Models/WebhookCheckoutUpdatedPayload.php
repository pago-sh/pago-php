<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Sent when a checkout is updated.
 *
 * **Discord & Slack support:** Basic
 */
final class WebhookCheckoutUpdatedPayload implements Model, Deserializable, WebhookPayload
{
    public function __construct(
        public readonly string $type,
        public readonly string $timestamp,
        public readonly Checkout $data,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $type = Json::toString(Json::get($data, 'type'));
        $timestamp = Json::toString(Json::get($data, 'timestamp'));
        $data = Checkout::fromArray(Json::toMap(Json::get($data, 'data')));

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