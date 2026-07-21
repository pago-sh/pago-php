<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to update the benefits granted by a product.
 */
final class ProductBenefitsUpdate implements Model, Deserializable
{
    public function __construct(
        /**
         * @var list<string>
         */
        public readonly array $benefits,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var list<string> $benefits */
        $benefits = array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList(Json::get($data, 'benefits')));

        return new self(
            benefits: $benefits,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['benefits'] = Json::encode($this->benefits);

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