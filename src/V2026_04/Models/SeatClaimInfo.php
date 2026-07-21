<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Read-only information about a seat claim invitation.
 * Safe for email scanners - no side effects when fetched.
 */
final class SeatClaimInfo implements Model, Deserializable
{
    public function __construct(
        public readonly string $product_name,
        public readonly string $product_id,
        public readonly string $organization_name,
        public readonly string $organization_slug,
        public readonly string $customer_email,
        public readonly bool $can_claim,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $product_name = Json::toString(Json::get($data, 'product_name'));
        $product_id = Json::toString(Json::get($data, 'product_id'));
        $organization_name = Json::toString(Json::get($data, 'organization_name'));
        $organization_slug = Json::toString(Json::get($data, 'organization_slug'));
        $customer_email = Json::toString(Json::get($data, 'customer_email'));
        $can_claim = Json::toBool(Json::get($data, 'can_claim'));

        return new self(
            product_name: $product_name,
            product_id: $product_id,
            organization_name: $organization_name,
            organization_slug: $organization_slug,
            customer_email: $customer_email,
            can_claim: $can_claim,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['product_name'] = Json::encode($this->product_name);
        $data['product_id'] = Json::encode($this->product_id);
        $data['organization_name'] = Json::encode($this->organization_name);
        $data['organization_slug'] = Json::encode($this->organization_slug);
        $data['customer_email'] = Json::encode($this->customer_email);
        $data['can_claim'] = Json::encode($this->can_claim);

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