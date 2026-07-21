<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * OrganizationDetails
 */
final class OrganizationDetails implements Model, Deserializable
{
    public function __construct(
        /**
         * @deprecated
         * @var string|null
         */
        public readonly ?string $about = null,
        /**
         * @var string|null
         */
        public readonly ?string $product_description = null,
        /**
         * @var list<string>|null
         */
        public readonly ?array $selling_categories = null,
        /**
         * @var list<string>|null
         */
        public readonly ?array $pricing_models = null,
        /**
         * @deprecated
         * @var string|null
         */
        public readonly ?string $intended_use = null,
        /**
         * @deprecated
         * @var list<string>|null
         */
        public readonly ?array $customer_acquisition = null,
        /**
         * @deprecated
         * @var int|null
         */
        public readonly ?int $future_annual_revenue = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $switching = null,
        /**
         * @var string|null
         */
        public readonly ?string $switching_from = null,
        /**
         * @deprecated
         * @var int|null
         */
        public readonly ?int $previous_annual_revenue = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var string|null $about */
        $about = isset($data['about']) ? Json::toString($data['about']) : null;
        /** @var string|null $product_description */
        $product_description = isset($data['product_description']) ? Json::toString($data['product_description']) : null;
        /** @var list<string>|null $selling_categories */
        $selling_categories = isset($data['selling_categories']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList($data['selling_categories'])) : null;
        /** @var list<string>|null $pricing_models */
        $pricing_models = isset($data['pricing_models']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList($data['pricing_models'])) : null;
        /** @var string|null $intended_use */
        $intended_use = isset($data['intended_use']) ? Json::toString($data['intended_use']) : null;
        /** @var list<string>|null $customer_acquisition */
        $customer_acquisition = isset($data['customer_acquisition']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList($data['customer_acquisition'])) : null;
        /** @var int|null $future_annual_revenue */
        $future_annual_revenue = isset($data['future_annual_revenue']) ? Json::toInt($data['future_annual_revenue']) : null;
        /** @var bool|null $switching */
        $switching = isset($data['switching']) ? Json::toBool($data['switching']) : null;
        /** @var string|null $switching_from */
        $switching_from = isset($data['switching_from']) ? $data['switching_from'] : null;
        /** @var int|null $previous_annual_revenue */
        $previous_annual_revenue = isset($data['previous_annual_revenue']) ? Json::toInt($data['previous_annual_revenue']) : null;

        return new self(
            about: $about,
            product_description: $product_description,
            selling_categories: $selling_categories,
            pricing_models: $pricing_models,
            intended_use: $intended_use,
            customer_acquisition: $customer_acquisition,
            future_annual_revenue: $future_annual_revenue,
            switching: $switching,
            switching_from: $switching_from,
            previous_annual_revenue: $previous_annual_revenue,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->about !== null) {
            $data['about'] = Json::encode($this->about);
        }
        if ($this->product_description !== null) {
            $data['product_description'] = Json::encode($this->product_description);
        }
        if ($this->selling_categories !== null) {
            $data['selling_categories'] = Json::encode($this->selling_categories);
        }
        if ($this->pricing_models !== null) {
            $data['pricing_models'] = Json::encode($this->pricing_models);
        }
        if ($this->intended_use !== null) {
            $data['intended_use'] = Json::encode($this->intended_use);
        }
        if ($this->customer_acquisition !== null) {
            $data['customer_acquisition'] = Json::encode($this->customer_acquisition);
        }
        if ($this->future_annual_revenue !== null) {
            $data['future_annual_revenue'] = Json::encode($this->future_annual_revenue);
        }
        if ($this->switching !== null) {
            $data['switching'] = Json::encode($this->switching);
        }
        if ($this->switching_from !== null) {
            $data['switching_from'] = Json::encode($this->switching_from);
        }
        if ($this->previous_annual_revenue !== null) {
            $data['previous_annual_revenue'] = Json::encode($this->previous_annual_revenue);
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