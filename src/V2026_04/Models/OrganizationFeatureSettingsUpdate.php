<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * Feature settings that organizations can update themselves.
 *
 * Other feature settings are managed by Pago staff: they're ignored if
 * provided and keep their current value.
 */
final class OrganizationFeatureSettingsUpdate implements Model, Deserializable
{
    public function __construct(
        /**
         * @var bool|null
         */
        public readonly ?bool $seat_based_pricing_enabled = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $member_model_enabled = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $checkout_localization_enabled = null,
        /**
         * @var list<string>|null
         */
        public readonly ?array $overview_metrics = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var bool|null $seat_based_pricing_enabled */
        $seat_based_pricing_enabled = isset($data['seat_based_pricing_enabled']) ? Json::toBool($data['seat_based_pricing_enabled']) : null;
        /** @var bool|null $member_model_enabled */
        $member_model_enabled = isset($data['member_model_enabled']) ? Json::toBool($data['member_model_enabled']) : null;
        /** @var bool|null $checkout_localization_enabled */
        $checkout_localization_enabled = isset($data['checkout_localization_enabled']) ? Json::toBool($data['checkout_localization_enabled']) : null;
        /** @var list<string>|null $overview_metrics */
        $overview_metrics = isset($data['overview_metrics']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList($data['overview_metrics'])) : null;

        return new self(
            seat_based_pricing_enabled: $seat_based_pricing_enabled,
            member_model_enabled: $member_model_enabled,
            checkout_localization_enabled: $checkout_localization_enabled,
            overview_metrics: $overview_metrics,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->seat_based_pricing_enabled !== null) {
            $data['seat_based_pricing_enabled'] = Json::encode($this->seat_based_pricing_enabled);
        }
        if ($this->member_model_enabled !== null) {
            $data['member_model_enabled'] = Json::encode($this->member_model_enabled);
        }
        if ($this->checkout_localization_enabled !== null) {
            $data['checkout_localization_enabled'] = Json::encode($this->checkout_localization_enabled);
        }
        if ($this->overview_metrics !== null) {
            $data['overview_metrics'] = Json::encode($this->overview_metrics);
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