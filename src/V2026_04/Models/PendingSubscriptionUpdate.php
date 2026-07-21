<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Pending update to be applied to a subscription at the beginning of the next period.
 */
final class PendingSubscriptionUpdate implements Model, Deserializable
{
    public function __construct(
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $id,
        public readonly string $applies_at,
        /**
         * @var string|null
         */
        public readonly ?string $product_id,
        /**
         * @var int|null
         */
        public readonly ?int $seats,
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
        $applies_at = Json::toString(Json::get($data, 'applies_at'));
        /** @var string|null $product_id */
        $product_id = (Json::get($data, 'product_id') === null ? null : Json::toString(Json::get($data, 'product_id')));
        /** @var int|null $seats */
        $seats = (Json::get($data, 'seats') === null ? null : Json::toInt(Json::get($data, 'seats')));

        return new self(
            created_at: $created_at,
            modified_at: $modified_at,
            id: $id,
            applies_at: $applies_at,
            product_id: $product_id,
            seats: $seats,
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
        $data['applies_at'] = Json::encode($this->applies_at);
        $data['product_id'] = Json::encode($this->product_id);
        $data['seats'] = Json::encode($this->seats);

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