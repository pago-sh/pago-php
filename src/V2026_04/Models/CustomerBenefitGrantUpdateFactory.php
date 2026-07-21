<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see CustomerBenefitGrantUpdate} variant for a payload.
 *
 * Dispatch is driven by the `benefit_type` discriminator property.
 */
final class CustomerBenefitGrantUpdateFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): CustomerBenefitGrantUpdate
    {
        $resolved = Union::resolve($data, 'benefit_type', ['custom' => CustomerBenefitGrantCustomUpdate::class, 'discord' => CustomerBenefitGrantDiscordUpdate::class, 'downloadables' => CustomerBenefitGrantDownloadablesUpdate::class, 'feature_flag' => CustomerBenefitGrantFeatureFlagUpdate::class, 'github_repository' => CustomerBenefitGrantGitHubRepositoryUpdate::class, 'license_keys' => CustomerBenefitGrantLicenseKeysUpdate::class, 'meter_credit' => CustomerBenefitGrantMeterCreditUpdate::class, 'slack_shared_channel' => CustomerBenefitGrantSlackSharedChannelUpdate::class], [CustomerBenefitGrantDiscordUpdate::class, CustomerBenefitGrantGitHubRepositoryUpdate::class, CustomerBenefitGrantDownloadablesUpdate::class, CustomerBenefitGrantLicenseKeysUpdate::class, CustomerBenefitGrantCustomUpdate::class, CustomerBenefitGrantMeterCreditUpdate::class, CustomerBenefitGrantFeatureFlagUpdate::class, CustomerBenefitGrantSlackSharedChannelUpdate::class]);

        if (!$resolved instanceof CustomerBenefitGrantUpdate) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any CustomerBenefitGrantUpdate variant.',
            );
        }

        return $resolved;
    }
}