<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * CustomerPortalSubscriptionSettings
 */
final class CustomerPortalSubscriptionSettings implements Model, Deserializable
{
    public function __construct(
        public readonly bool $update_seats,
        public readonly bool $update_plan,
        /**
         * @var bool|null
         */
        public readonly ?bool $pause = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $update_seats = Json::toBool(Json::get($data, 'update_seats'));
        $update_plan = Json::toBool(Json::get($data, 'update_plan'));
        /** @var bool|null $pause */
        $pause = isset($data['pause']) ? Json::toBool($data['pause']) : null;

        return new self(
            update_seats: $update_seats,
            update_plan: $update_plan,
            pause: $pause,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['update_seats'] = Json::encode($this->update_seats);
        $data['update_plan'] = Json::encode($this->update_plan);
        if ($this->pause !== null) {
            $data['pause'] = Json::encode($this->pause);
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