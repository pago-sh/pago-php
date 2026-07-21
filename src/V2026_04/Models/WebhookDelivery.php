<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * A webhook delivery for a webhook event.
 */
final class WebhookDelivery implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly bool $succeeded,
        /**
         * @var int|null
         */
        public readonly ?int $http_code,
        /**
         * @var string|null
         */
        public readonly ?string $response,
        public readonly WebhookEvent $webhook_event,
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
        $succeeded = Json::toBool(Json::get($data, 'succeeded'));
        /** @var int|null $http_code */
        $http_code = (Json::get($data, 'http_code') === null ? null : Json::toInt(Json::get($data, 'http_code')));
        /** @var string|null $response */
        $response = (Json::get($data, 'response') === null ? null : Json::toString(Json::get($data, 'response')));
        $webhook_event = WebhookEvent::fromArray(Json::toMap(Json::get($data, 'webhook_event')));

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            succeeded: $succeeded,
            http_code: $http_code,
            response: $response,
            webhook_event: $webhook_event,
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
        $data['succeeded'] = Json::encode($this->succeeded);
        $data['http_code'] = Json::encode($this->http_code);
        $data['response'] = Json::encode($this->response);
        $data['webhook_event'] = Json::encode($this->webhook_event);

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