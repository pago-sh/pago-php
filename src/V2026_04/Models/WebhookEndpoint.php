<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * A webhook endpoint.
 */
final class WebhookEndpoint implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly string $url,
        public readonly WebhookFormat $format,
        public readonly string $secret,
        public readonly string $organization_id,
        /**
         * @var list<WebhookEventType>
         */
        public readonly array $events,
        public readonly bool $enabled,
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
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
        $url = Json::toString(Json::get($data, 'url'));
        $format = WebhookFormat::from(Json::toString(Json::get($data, 'format')));
        $secret = Json::toString(Json::get($data, 'secret'));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        /** @var list<WebhookEventType> $events */
        $events = array_map(static fn (mixed $item0): WebhookEventType => WebhookEventType::from(Json::toString($item0)), Json::toList(Json::get($data, 'events')));
        $enabled = Json::toBool(Json::get($data, 'enabled'));
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            url: $url,
            format: $format,
            secret: $secret,
            organization_id: $organization_id,
            events: $events,
            enabled: $enabled,
            name: $name,
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
        $data['url'] = Json::encode($this->url);
        $data['format'] = Json::encode($this->format);
        $data['secret'] = Json::encode($this->secret);
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['events'] = Json::encode($this->events);
        $data['enabled'] = Json::encode($this->enabled);
        if ($this->name !== null) {
            $data['name'] = Json::encode($this->name);
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