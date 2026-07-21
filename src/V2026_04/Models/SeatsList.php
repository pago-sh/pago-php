<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * SeatsList
 */
final class SeatsList implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<CustomerSeat>
         */
        public readonly array $seats,
        public readonly int $available_seats,
        public readonly int $total_seats,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<CustomerSeat> $seats */
        $seats = array_map(static fn (mixed $item0): CustomerSeat => CustomerSeat::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'seats')));
        $available_seats = Json::toInt(Json::get($data, 'available_seats'));
        $total_seats = Json::toInt(Json::get($data, 'total_seats'));

        return new self(
            seats: $seats,
            available_seats: $available_seats,
            total_seats: $total_seats,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['seats'] = Json::encode($this->seats);
        $data['available_seats'] = Json::encode($this->available_seats);
        $data['total_seats'] = Json::encode($this->total_seats);

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