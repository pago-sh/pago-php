<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * ProductCreateRecurring
 */
final class ProductCreateRecurring implements Model, Deserializable, ProductCreate
{
    public function __construct(
        public readonly string $name,
        /**
         * @var list<ProductPriceFixedCreate|ProductPriceCustomCreate|ProductPriceSeatBasedCreate|ProductPriceMeteredUnitCreate>
         */
        public readonly array $prices,
        public readonly RecurringInterval $recurring_interval,
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
        /**
         * @var TrialInterval|null
         */
        public readonly ?TrialInterval $trial_interval = null,
        /**
         * @var int|null
         */
        public readonly ?int $trial_interval_count = null,
        /**
         * @var int|null
         */
        public readonly ?int $recurring_interval_count = null,
        /**
         * @var RecurringInterval|null
         */
        public readonly ?RecurringInterval $meter_interval = null,
        /**
         * @var int|null
         */
        public readonly ?int $meter_interval_count = null,
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
        $recurring_interval = RecurringInterval::from(Json::toString(Json::get($data, 'recurring_interval')));
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
        /** @var TrialInterval|null $trial_interval */
        $trial_interval = isset($data['trial_interval']) ? TrialInterval::from(Json::toString($data['trial_interval'])) : null;
        /** @var int|null $trial_interval_count */
        $trial_interval_count = isset($data['trial_interval_count']) ? Json::toInt($data['trial_interval_count']) : null;
        /** @var int|null $recurring_interval_count */
        $recurring_interval_count = isset($data['recurring_interval_count']) ? Json::toInt($data['recurring_interval_count']) : null;
        /** @var RecurringInterval|null $meter_interval */
        $meter_interval = isset($data['meter_interval']) ? RecurringInterval::from(Json::toString($data['meter_interval'])) : null;
        /** @var int|null $meter_interval_count */
        $meter_interval_count = isset($data['meter_interval_count']) ? Json::toInt($data['meter_interval_count']) : null;

        return new self(
            name: $name,
            prices: $prices,
            recurring_interval: $recurring_interval,
            metadata: $metadata,
            description: $description,
            visibility: $visibility,
            medias: $medias,
            attached_custom_fields: $attached_custom_fields,
            organization_id: $organization_id,
            trial_interval: $trial_interval,
            trial_interval_count: $trial_interval_count,
            recurring_interval_count: $recurring_interval_count,
            meter_interval: $meter_interval,
            meter_interval_count: $meter_interval_count,
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
        $data['recurring_interval'] = Json::encode($this->recurring_interval);
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
        if ($this->trial_interval !== null) {
            $data['trial_interval'] = Json::encode($this->trial_interval);
        }
        if ($this->trial_interval_count !== null) {
            $data['trial_interval_count'] = Json::encode($this->trial_interval_count);
        }
        if ($this->recurring_interval_count !== null) {
            $data['recurring_interval_count'] = Json::encode($this->recurring_interval_count);
        }
        if ($this->meter_interval !== null) {
            $data['meter_interval'] = Json::encode($this->meter_interval);
        }
        if ($this->meter_interval_count !== null) {
            $data['meter_interval_count'] = Json::encode($this->meter_interval_count);
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