<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Schema of a product for customer portal.
 */
final class CustomerProduct implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        /**
         * @var TrialInterval|null
         */
        public readonly ?TrialInterval $trial_interval,
        /**
         * @var int|null
         */
        public readonly ?int $trial_interval_count,
        public readonly string $name,
        /**
         * @var string|null
         */
        public readonly ?string $description,
        public readonly ProductVisibility $visibility,
        /**
         * @var RecurringInterval|null
         */
        public readonly ?RecurringInterval $recurring_interval,
        /**
         * @var int|null
         */
        public readonly ?int $recurring_interval_count,
        /**
         * @var RecurringInterval|null
         */
        public readonly ?RecurringInterval $meter_interval,
        /**
         * @var int|null
         */
        public readonly ?int $meter_interval_count,
        public readonly bool $is_recurring,
        public readonly bool $is_archived,
        public readonly string $organization_id,
        /**
         * @var list<LegacyRecurringProductPrice|ProductPrice>
         */
        public readonly array $prices,
        /**
         * @var list<BenefitPublic>
         */
        public readonly array $benefits,
        /**
         * @var list<ProductMediaFileRead>
         */
        public readonly array $medias,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $id = Json::toString(Json::get($data, 'id'));
        $created_at = Json::toString(Json::get($data, 'created_at'));
        /** @var string|null $modified_at */
        $modified_at = (Json::get($data, 'modified_at') === null ? null : Json::toString(Json::get($data, 'modified_at')));
        /** @var TrialInterval|null $trial_interval */
        $trial_interval = (Json::get($data, 'trial_interval') === null ? null : TrialInterval::from(Json::toString(Json::get($data, 'trial_interval'))));
        /** @var int|null $trial_interval_count */
        $trial_interval_count = (Json::get($data, 'trial_interval_count') === null ? null : Json::toInt(Json::get($data, 'trial_interval_count')));
        $name = Json::toString(Json::get($data, 'name'));
        /** @var string|null $description */
        $description = (Json::get($data, 'description') === null ? null : Json::toString(Json::get($data, 'description')));
        $visibility = ProductVisibility::from(Json::toString(Json::get($data, 'visibility')));
        /** @var RecurringInterval|null $recurring_interval */
        $recurring_interval = (Json::get($data, 'recurring_interval') === null ? null : RecurringInterval::from(Json::toString(Json::get($data, 'recurring_interval'))));
        /** @var int|null $recurring_interval_count */
        $recurring_interval_count = (Json::get($data, 'recurring_interval_count') === null ? null : Json::toInt(Json::get($data, 'recurring_interval_count')));
        /** @var RecurringInterval|null $meter_interval */
        $meter_interval = (Json::get($data, 'meter_interval') === null ? null : RecurringInterval::from(Json::toString(Json::get($data, 'meter_interval'))));
        /** @var int|null $meter_interval_count */
        $meter_interval_count = (Json::get($data, 'meter_interval_count') === null ? null : Json::toInt(Json::get($data, 'meter_interval_count')));
        $is_recurring = Json::toBool(Json::get($data, 'is_recurring'));
        $is_archived = Json::toBool(Json::get($data, 'is_archived'));
        $organization_id = Json::toString(Json::get($data, 'organization_id'));
        /** @var list<LegacyRecurringProductPrice|ProductPrice> $prices */
        $prices = array_map(static fn (mixed $item0): mixed => Union::resolve($item0, null, [], [LegacyRecurringProductPriceFactory::class, ProductPriceFactory::class]), Json::toList(Json::get($data, 'prices')));
        /** @var list<BenefitPublic> $benefits */
        $benefits = array_map(static fn (mixed $item0): BenefitPublic => BenefitPublic::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'benefits')));
        /** @var list<ProductMediaFileRead> $medias */
        $medias = array_map(static fn (mixed $item0): ProductMediaFileRead => ProductMediaFileRead::fromArray(Json::toMap($item0)), Json::toList(Json::get($data, 'medias')));

        return new self(
            id: $id,
            created_at: $created_at,
            modified_at: $modified_at,
            trial_interval: $trial_interval,
            trial_interval_count: $trial_interval_count,
            name: $name,
            description: $description,
            visibility: $visibility,
            recurring_interval: $recurring_interval,
            recurring_interval_count: $recurring_interval_count,
            meter_interval: $meter_interval,
            meter_interval_count: $meter_interval_count,
            is_recurring: $is_recurring,
            is_archived: $is_archived,
            organization_id: $organization_id,
            prices: $prices,
            benefits: $benefits,
            medias: $medias,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = Json::encode($this->id);
        $data['created_at'] = Json::encode($this->created_at);
        $data['modified_at'] = Json::encode($this->modified_at);
        $data['trial_interval'] = Json::encode($this->trial_interval);
        $data['trial_interval_count'] = Json::encode($this->trial_interval_count);
        $data['name'] = Json::encode($this->name);
        $data['description'] = Json::encode($this->description);
        $data['visibility'] = Json::encode($this->visibility);
        $data['recurring_interval'] = Json::encode($this->recurring_interval);
        $data['recurring_interval_count'] = Json::encode($this->recurring_interval_count);
        $data['meter_interval'] = Json::encode($this->meter_interval);
        $data['meter_interval_count'] = Json::encode($this->meter_interval_count);
        $data['is_recurring'] = Json::encode($this->is_recurring);
        $data['is_archived'] = Json::encode($this->is_archived);
        $data['organization_id'] = Json::encode($this->organization_id);
        $data['prices'] = Json::encode($this->prices);
        $data['benefits'] = Json::encode($this->benefits);
        $data['medias'] = Json::encode($this->medias);

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