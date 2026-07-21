<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema to update a product.
 */
final class ProductUpdate implements Model, Deserializable
{
    public function __construct(
        /**
         * @var array<string, string|int|float|bool>|null
         */
        public readonly ?array $metadata = null,
        /**
         * @var TrialInterval|null
         */
        public readonly ?TrialInterval $trial_interval = null,
        /**
         * @var int|null
         */
        public readonly ?int $trial_interval_count = null,
        /**
         * @var string|null
         */
        public readonly ?string $name = null,
        /**
         * @var string|null
         */
        public readonly ?string $description = null,
        /**
         * @var RecurringInterval|null
         */
        public readonly ?RecurringInterval $recurring_interval = null,
        /**
         * @var int|null
         */
        public readonly ?int $recurring_interval_count = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $is_archived = null,
        /**
         * @var ProductVisibility|null
         */
        public readonly ?ProductVisibility $visibility = null,
        /**
         * @var list<ExistingProductPrice|ProductPriceFixedCreate|ProductPriceCustomCreate|ProductPriceSeatBasedCreate|ProductPriceMeteredUnitCreate>|null
         */
        public readonly ?array $prices = null,
        /**
         * @var list<string>|null
         */
        public readonly ?array $medias = null,
        /**
         * @var list<AttachedCustomFieldCreate>|null
         */
        public readonly ?array $attached_custom_fields = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var array<string, string|int|float|bool>|null $metadata */
        $metadata = isset($data['metadata']) ? Json::toMap($data['metadata']) : null;
        /** @var TrialInterval|null $trial_interval */
        $trial_interval = isset($data['trial_interval']) ? TrialInterval::from(Json::toString($data['trial_interval'])) : null;
        /** @var int|null $trial_interval_count */
        $trial_interval_count = isset($data['trial_interval_count']) ? Json::toInt($data['trial_interval_count']) : null;
        /** @var string|null $name */
        $name = isset($data['name']) ? Json::toString($data['name']) : null;
        /** @var string|null $description */
        $description = isset($data['description']) ? Json::toString($data['description']) : null;
        /** @var RecurringInterval|null $recurring_interval */
        $recurring_interval = isset($data['recurring_interval']) ? RecurringInterval::from(Json::toString($data['recurring_interval'])) : null;
        /** @var int|null $recurring_interval_count */
        $recurring_interval_count = isset($data['recurring_interval_count']) ? Json::toInt($data['recurring_interval_count']) : null;
        /** @var bool|null $is_archived */
        $is_archived = isset($data['is_archived']) ? Json::toBool($data['is_archived']) : null;
        /** @var ProductVisibility|null $visibility */
        $visibility = isset($data['visibility']) ? ProductVisibility::from(Json::toString($data['visibility'])) : null;
        /** @var list<ExistingProductPrice|ProductPriceFixedCreate|ProductPriceCustomCreate|ProductPriceSeatBasedCreate|ProductPriceMeteredUnitCreate>|null $prices */
        $prices = isset($data['prices']) ? array_map(static fn (mixed $item0): mixed => Union::resolve($item0, null, [], [ExistingProductPrice::class]), Json::toList($data['prices'])) : null;
        /** @var list<string>|null $medias */
        $medias = isset($data['medias']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList($data['medias'])) : null;
        /** @var list<AttachedCustomFieldCreate>|null $attached_custom_fields */
        $attached_custom_fields = isset($data['attached_custom_fields']) ? array_map(static fn (mixed $item0): AttachedCustomFieldCreate => AttachedCustomFieldCreate::fromArray(Json::toMap($item0)), Json::toList($data['attached_custom_fields'])) : null;

        return new self(
            metadata: $metadata,
            trial_interval: $trial_interval,
            trial_interval_count: $trial_interval_count,
            name: $name,
            description: $description,
            recurring_interval: $recurring_interval,
            recurring_interval_count: $recurring_interval_count,
            is_archived: $is_archived,
            visibility: $visibility,
            prices: $prices,
            medias: $medias,
            attached_custom_fields: $attached_custom_fields,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->metadata !== null) {
            $data['metadata'] = Json::encode($this->metadata);
        }
        if ($this->trial_interval !== null) {
            $data['trial_interval'] = Json::encode($this->trial_interval);
        }
        if ($this->trial_interval_count !== null) {
            $data['trial_interval_count'] = Json::encode($this->trial_interval_count);
        }
        if ($this->name !== null) {
            $data['name'] = Json::encode($this->name);
        }
        if ($this->description !== null) {
            $data['description'] = Json::encode($this->description);
        }
        if ($this->recurring_interval !== null) {
            $data['recurring_interval'] = Json::encode($this->recurring_interval);
        }
        if ($this->recurring_interval_count !== null) {
            $data['recurring_interval_count'] = Json::encode($this->recurring_interval_count);
        }
        if ($this->is_archived !== null) {
            $data['is_archived'] = Json::encode($this->is_archived);
        }
        if ($this->visibility !== null) {
            $data['visibility'] = Json::encode($this->visibility);
        }
        if ($this->prices !== null) {
            $data['prices'] = Json::encode($this->prices);
        }
        if ($this->medias !== null) {
            $data['medias'] = Json::encode($this->medias);
        }
        if ($this->attached_custom_fields !== null) {
            $data['attached_custom_fields'] = Json::encode($this->attached_custom_fields);
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