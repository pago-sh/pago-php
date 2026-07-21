<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to create a webhook endpoint.
 */
final class WebhookEndpointCreate implements Model, Deserializable
{
    public function __construct(
        public readonly string $url,
        public readonly WebhookFormat $format,
        /**
         * @var list<WebhookEventType>
         */
        public readonly array $events,
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
        /**
         * @var string|null
         */
        public readonly ?string $organization_id = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $url = Json::toString(Json::get($data, 'url'));
        $format = WebhookFormat::from(Json::toString(Json::get($data, 'format')));
        /** @var list<WebhookEventType> $events */
        $events = array_map(static fn (mixed $item0): WebhookEventType => WebhookEventType::from(Json::toString($item0)), Json::toList(Json::get($data, 'events')));
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;
        /** @var string|null $organization_id */
        $organization_id = isset($data['organization_id']) ? Json::toString($data['organization_id']) : null;

        return new self(
            url: $url,
            format: $format,
            events: $events,
            name: $name,
            organization_id: $organization_id,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['url'] = Json::encode($this->url);
        $data['format'] = Json::encode($this->format);
        $data['events'] = Json::encode($this->events);
        if ($this->name !== null) {
            $data['name'] = Json::encode($this->name);
        }
        if ($this->organization_id !== null) {
            $data['organization_id'] = Json::encode($this->organization_id);
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