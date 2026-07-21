<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * ProductCreateOneTime
 */
final class ProductCreateOneTime implements Model, Deserializable, ProductCreate
{
    public function __construct(
        public readonly string $name,
        /**
         * @var list<ProductPriceFixedCreate|ProductPriceCustomCreate|ProductPriceSeatBasedCreate|ProductPriceMeteredUnitCreate>
         */
        public readonly array $prices,
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
        /**
         * @var string|null
         */
        public readonly ?string $description = null,
        /**
         * @var ProductVisibility|null
         */
        public readonly ?ProductVisibility $visibility = null,
        /**
         * @var list<string>|null
         */
        public readonly ?array $medias = null,
        /**
         * @var list<AttachedCustomFieldCreate>|null
         */
        public readonly ?array $attached_custom_fields = null,
        /**
         * @var string|null
         */
        public readonly ?string $organization_id = null,
        public readonly null $recurring_interval = null,
        public readonly null $recurring_interval_count = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $name = Json::toString(Json::get($data, 'name'));
        /** @var list<ProductPriceFixedCreate|ProductPriceCustomCreate|ProductPriceSeatBasedCreate|ProductPriceMeteredUnitCreate> $prices */
        $prices = array_map(static fn (mixed $item0): mixed => Union::resolve($item0, 'amount_type', ['custom' => ProductPriceCustomCreate::class, 'fixed' => ProductPriceFixedCreate::class, 'metered_unit' => ProductPriceMeteredUnitCreate::class, 'seat_based' => ProductPriceSeatBasedCreate::class], [ProductPriceFixedCreate::class, ProductPriceCustomCreate::class, ProductPriceSeatBasedCreate::class, ProductPriceMeteredUnitCreate::class]), Json::toList(Json::get($data, 'prices')));
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var string|null $description */
        $description = isset($data['description']) ? Json::toString($data['description']) : null;
        /** @var ProductVisibility|null $visibility */
        $visibility = isset($data['visibility']) ? ProductVisibility::from(Json::toString($data['visibility'])) : null;
        /** @var list<string>|null $medias */
        $medias = isset($data['medias']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList($data['medias'])) : null;
        /** @var list<AttachedCustomFieldCreate>|null $attached_custom_fields */
        $attached_custom_fields = isset($data['attached_custom_fields']) ? array_map(static fn (mixed $item0): AttachedCustomFieldCreate => AttachedCustomFieldCreate::fromArray(Json::toMap($item0)), Json::toList($data['attached_custom_fields'])) : null;
        /** @var string|null $organization_id */
        $organization_id = isset($data['organization_id']) ? Json::toString($data['organization_id']) : null;
        $recurring_interval = null;
        $recurring_interval_count = null;

        return new self(
            name: $name,
            prices: $prices,
            metadata: $metadata,
            description: $description,
            visibility: $visibility,
            medias: $medias,
            attached_custom_fields: $attached_custom_fields,
            organization_id: $organization_id,
            recurring_interval: $recurring_interval,
            recurring_interval_count: $recurring_interval_count,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = Json::encode($this->name);
        $data['prices'] = Json::encode($this->prices);
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->description !== null) {
            $data['description'] = Json::encode($this->description);
        }
        if ($this->visibility !== null) {
            $data['visibility'] = Json::encode($this->visibility);
        }
        if ($this->medias !== null) {
            $data['medias'] = Json::encode($this->medias);
        }
        if ($this->attached_custom_fields !== null) {
            $data['attached_custom_fields'] = Json::encode($this->attached_custom_fields);
        }
        if ($this->organization_id !== null) {
            $data['organization_id'] = Json::encode($this->organization_id);
        }
        $data['recurring_interval'] = Json::encode($this->recurring_interval);
        $data['recurring_interval_count'] = Json::encode($this->recurring_interval_count);

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