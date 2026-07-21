<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * OrganizationFeatureSettings
 */
final class OrganizationFeatureSettings implements Model, Deserializable
{
    public function __construct(
        /**
         * @var bool|null
         */
        public readonly ?bool $issue_funding_enabled = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $seat_based_pricing_enabled = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $wallets_enabled = null,
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
        /**
         * @var bool|null
         */
        public readonly ?bool $reset_proration_behavior_enabled = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $off_session_charges_enabled = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $slack_benefit_enabled = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $preview_access_enabled = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $disputes_enabled = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $sso_enabled = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $compass_enabled = null,
        /**
         * @var bool|null
         */
        public readonly ?bool $merchant_migration_enabled = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /** @var bool|null $issue_funding_enabled */
        $issue_funding_enabled = isset($data['issue_funding_enabled']) ? Json::toBool($data['issue_funding_enabled']) : null;
        /** @var bool|null $seat_based_pricing_enabled */
        $seat_based_pricing_enabled = isset($data['seat_based_pricing_enabled']) ? Json::toBool($data['seat_based_pricing_enabled']) : null;
        /** @var bool|null $wallets_enabled */
        $wallets_enabled = isset($data['wallets_enabled']) ? Json::toBool($data['wallets_enabled']) : null;
        /** @var bool|null $member_model_enabled */
        $member_model_enabled = isset($data['member_model_enabled']) ? Json::toBool($data['member_model_enabled']) : null;
        /** @var bool|null $checkout_localization_enabled */
        $checkout_localization_enabled = isset($data['checkout_localization_enabled']) ? Json::toBool($data['checkout_localization_enabled']) : null;
        /** @var list<string>|null $overview_metrics */
        $overview_metrics = isset($data['overview_metrics']) ? array_map(static fn (mixed $item0): string => Json::toString($item0), Json::toList($data['overview_metrics'])) : null;
        /** @var bool|null $reset_proration_behavior_enabled */
        $reset_proration_behavior_enabled = isset($data['reset_proration_behavior_enabled']) ? Json::toBool($data['reset_proration_behavior_enabled']) : null;
        /** @var bool|null $off_session_charges_enabled */
        $off_session_charges_enabled = isset($data['off_session_charges_enabled']) ? Json::toBool($data['off_session_charges_enabled']) : null;
        /** @var bool|null $slack_benefit_enabled */
        $slack_benefit_enabled = isset($data['slack_benefit_enabled']) ? Json::toBool($data['slack_benefit_enabled']) : null;
        /** @var bool|null $preview_access_enabled */
        $preview_access_enabled = isset($data['preview_access_enabled']) ? Json::toBool($data['preview_access_enabled']) : null;
        /** @var bool|null $disputes_enabled */
        $disputes_enabled = isset($data['disputes_enabled']) ? Json::toBool($data['disputes_enabled']) : null;
        /** @var bool|null $sso_enabled */
        $sso_enabled = isset($data['sso_enabled']) ? Json::toBool($data['sso_enabled']) : null;
        /** @var bool|null $compass_enabled */
        $compass_enabled = isset($data['compass_enabled']) ? Json::toBool($data['compass_enabled']) : null;
        /** @var bool|null $merchant_migration_enabled */
        $merchant_migration_enabled = isset($data['merchant_migration_enabled']) ? Json::toBool($data['merchant_migration_enabled']) : null;

        return new self(
            issue_funding_enabled: $issue_funding_enabled,
            seat_based_pricing_enabled: $seat_based_pricing_enabled,
            wallets_enabled: $wallets_enabled,
            member_model_enabled: $member_model_enabled,
            checkout_localization_enabled: $checkout_localization_enabled,
            overview_metrics: $overview_metrics,
            reset_proration_behavior_enabled: $reset_proration_behavior_enabled,
            off_session_charges_enabled: $off_session_charges_enabled,
            slack_benefit_enabled: $slack_benefit_enabled,
            preview_access_enabled: $preview_access_enabled,
            disputes_enabled: $disputes_enabled,
            sso_enabled: $sso_enabled,
            compass_enabled: $compass_enabled,
            merchant_migration_enabled: $merchant_migration_enabled,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->issue_funding_enabled !== null) {
            $data['issue_funding_enabled'] = Json::encode($this->issue_funding_enabled);
        }
        if ($this->seat_based_pricing_enabled !== null) {
            $data['seat_based_pricing_enabled'] = Json::encode($this->seat_based_pricing_enabled);
        }
        if ($this->wallets_enabled !== null) {
            $data['wallets_enabled'] = Json::encode($this->wallets_enabled);
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
        if ($this->reset_proration_behavior_enabled !== null) {
            $data['reset_proration_behavior_enabled'] = Json::encode($this->reset_proration_behavior_enabled);
        }
        if ($this->off_session_charges_enabled !== null) {
            $data['off_session_charges_enabled'] = Json::encode($this->off_session_charges_enabled);
        }
        if ($this->slack_benefit_enabled !== null) {
            $data['slack_benefit_enabled'] = Json::encode($this->slack_benefit_enabled);
        }
        if ($this->preview_access_enabled !== null) {
            $data['preview_access_enabled'] = Json::encode($this->preview_access_enabled);
        }
        if ($this->disputes_enabled !== null) {
            $data['disputes_enabled'] = Json::encode($this->disputes_enabled);
        }
        if ($this->sso_enabled !== null) {
            $data['sso_enabled'] = Json::encode($this->sso_enabled);
        }
        if ($this->compass_enabled !== null) {
            $data['compass_enabled'] = Json::encode($this->compass_enabled);
        }
        if ($this->merchant_migration_enabled !== null) {
            $data['merchant_migration_enabled'] = Json::encode($this->merchant_migration_enabled);
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