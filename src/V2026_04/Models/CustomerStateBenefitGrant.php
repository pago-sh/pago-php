<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Contracts\Model;
use Pago\Serialization\Json;
use Pago\Serialization\Union;

/**
 * An active benefit grant for a customer.
 */
final class CustomerStateBenefitGrant implements Model, Deserializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $created_at,
        /**
         * @var string|null
         */
        public readonly ?string $modified_at,
        public readonly string $granted_at,
        public readonly string $benefit_id,
        public readonly BenefitType $benefit_type,
        /**
         * @var array<string, string|int|float|bool>
         */
        public readonly array $benefit_metadata,
        public readonly BenefitGrantDiscordProperties|BenefitGrantGitHubRepositoryProperties|BenefitGrantDownloadablesProperties|BenefitGrantLicenseKeysProperties|BenefitGrantCustomProperties|BenefitGrantFeatureFlagProperties|BenefitGrantSlackSharedChannelProperties $properties,
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
        $granted_at = Json::toString(Json::get($data, 'granted_at'));
        $benefit_id = Json::toString(Json::get($data, 'benefit_id'));
        $benefit_type = BenefitType::from(Json::toString(Json::get($data, 'benefit_type')));
        /** @var array<string, string|int|float|bool> $benefit_metadata */
        $benefit_metadata = Json::toMap(Json::get($data, 'benefit_metadata'));
        /** @var BenefitGrantDiscordProperties|BenefitGrantGitHubRepositoryProperties|BenefitGrantDownloadablesProperties|BenefitGrantLicenseKeysProperties|BenefitGrantCustomProperties|BenefitGrantFeatureFlagProperties|BenefitGrantSlackSharedChannelProperties $properties */
        $properties = Union::resolve(Json::get($data, 'properties'), null, [], [BenefitGrantDiscordProperties::class, BenefitGrantGitHubRepositoryProperties::class, BenefitGrantDownloadablesProperties::class, BenefitGrantLicenseKeysProperties::class, BenefitGrantCustomProperties::class, BenefitGrantFeatureFlagProperties::class, BenefitGrantSlackSharedChannelProperties::class]);

        return new self(
            id: $id,
            created_at: $created_at,
            modified_at: $modified_at,
            granted_at: $granted_at,
            benefit_id: $benefit_id,
            benefit_type: $benefit_type,
            benefit_metadata: $benefit_metadata,
            properties: $properties,
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
        $data['granted_at'] = Json::encode($this->granted_at);
        $data['benefit_id'] = Json::encode($this->benefit_id);
        $data['benefit_type'] = Json::encode($this->benefit_type);
        $data['benefit_metadata'] = Json::encode($this->benefit_metadata);
        $data['properties'] = Json::encode($this->properties);

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