<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Response after successfully claiming a seat.
 */
final class CustomerSeatClaimResponse implements Model, Deserializable
{
    public function __construct(
        public readonly CustomerSeat $seat,
        public readonly string $customer_session_token,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $seat = CustomerSeat::fromArray(Json::toMap(Json::get($data, 'seat')));
        $customer_session_token = Json::toString(Json::get($data, 'customer_session_token'));

        return new self(
            seat: $seat,
            customer_session_token: $customer_session_token,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['seat'] = Json::encode($this->seat);
        $data['customer_session_token'] = Json::encode($this->customer_session_token);

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