<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema of an organization and related data for customer portal.
 */
final class CustomerOrganizationData implements Model, Deserializable
{
    public function __construct(
        public readonly CustomerOrganization $organization,
        /**
         * @var list<CustomerProduct>
         */
        public readonly array $products,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $organization = CustomerOrganization::fromArray(Json::toMap(Json::get($data, 'organization')));
        /** @var list<CustomerProduct> $products */
        $products = array_map(static fn (mixed $item0): CustomerProduct => CustomerProduct::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'products')));

        return new self(
            organization: $organization,
            products: $products,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['organization'] = Json::encode($this->organization);
        $data['products'] = Json::encode($this->products);

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