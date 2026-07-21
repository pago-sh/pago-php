<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to update a webhook endpoint.
 */
final class WebhookEndpointUpdate implements Model, Deserializable
{
    public function __construct(
        /**
         * @var string|null
         */
        public readonly ?string $url = null,
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
        /**
         * @var WebhookFormat|null
         */
        public readonly ?WebhookFormat $format = null,
        /**
         * @var list<WebhookEventType>|null
         */
        public readonly ?array $events = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $enabled = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $url */
        $url = isset($data['url']) ? Json::toString($data['url']) : null;
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;
        /** @var WebhookFormat|null $format */
        $format = isset($data['format']) ? WebhookFormat::from(Json::toString($data['format'])) : null;
        /** @var list<WebhookEventType>|null $events */
        $events = isset($data['events']) ? array_map(static fn (mixed $item0): WebhookEventType => WebhookEventType::from(Json::toString($item0)), Json::toList($data['events'])) : null;
        /** @var bool|null $enabled */
        $enabled = isset($data['enabled']) ? Json::toBool($data['enabled']) : null;

        return new self(
            url: $url,
            name: $name,
            format: $format,
            events: $events,
            enabled: $enabled,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->url !== null) {
            $data['url'] = Json::encode($this->url);
        }
        if ($this->name !== null) {
            $data['name'] = Json::encode($this->name);
        }
        if ($this->format !== null) {
            $data['format'] = Json::encode($this->format);
        }
        if ($this->events !== null) {
            $data['events'] = Json::encode($this->events);
        }
        if ($this->enabled !== null) {
            $data['enabled'] = Json::encode($this->enabled);
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