<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * EventsIngest
 */
final class EventsIngest implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<EventCreateCustomer|EventCreateExternalCustomer>
         */
        public readonly array $events,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<EventCreateCustomer|EventCreateExternalCustomer> $events */
        $events = array_map(static fn (mixed $item0): mixed => Union::resolve($item0, null, [], [EventCreateCustomer::class, EventCreateExternalCustomer::class]), Json::toList(Json::get($data, 'events')));

        return new self(
            events: $events,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['events'] = Json::encode($this->events);

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