<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * A webhook event.
 *
 * An event represent something that happened in the system
 * that should be sent to the webhook endpoint.
 *
 * It can be delivered multiple times until it's marked as succeeded,
 * each one creating a new delivery.
 */
final class WebhookEvent implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly bool $skipped,
        /**
         * @var string|null
         */
        public readonly ?string $payload,
        public readonly WebhookEventType $type,
        public readonly bool $is_archived,
        /**
         * @var int|null
         */
        public readonly ?int $last_http_code = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $succeeded = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        $id = Json::toString(Json::get($data, 'id'));
        $skipped = Json::toBool(Json::get($data, 'skipped'));
        /** @var string|null $payload */
        $payload = (Json::get($data, 'payload') === null ? null : Json::toString(Json::get($data, 'payload')));
        $type = WebhookEventType::from(Json::toString(Json::get($data, 'type')));
        $is_archived = Json::toBool(Json::get($data, 'is_archived'));
        /** @var int|null $last_http_code */
        $last_http_code = isset($data['last_http_code']) ? Json::toInt($data['last_http_code']) : null;
        /** @var bool|null $succeeded */
        $succeeded = isset($data['succeeded']) ? Json::toBool($data['succeeded']) : null;

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            skipped: $skipped,
            payload: $payload,
            type: $type,
            is_archived: $is_archived,
            last_http_code: $last_http_code,
            succeeded: $succeeded,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['id'] = Json::encode($this->id);
        $data['skipped'] = Json::encode($this->skipped);
        $data['payload'] = Json::encode($this->payload);
        $data['type'] = Json::encode($this->type);
        $data['is_archived'] = Json::encode($this->is_archived);
        if ($this->last_http_code !== null) {
            $data['last_http_code'] = Json::encode($this->last_http_code);
        }
        if ($this->succeeded !== null) {
            $data['succeeded'] = Json::encode($this->succeeded);
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