<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see BenefitCreate} variant for a payload.
 *
 * Dispatch is driven by the `type` discriminator property.
 */
final class BenefitCreateFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): BenefitCreate
    {
        $resolved = Union::resolve($data, 'type', ['custom' => BenefitCustomCreate::class, 'discord' => BenefitDiscordCreate::class, 'downloadables' => BenefitDownloadablesCreate::class, 'feature_flag' => BenefitFeatureFlagCreate::class, 'github_repository' => BenefitGitHubRepositoryCreate::class, 'license_keys' => BenefitLicenseKeysCreate::class, 'meter_credit' => BenefitMeterCreditCreate::class, 'slack_shared_channel' => BenefitSlackSharedChannelCreate::class], [BenefitCustomCreate::class, BenefitDiscordCreate::class, BenefitGitHubRepositoryCreate::class, BenefitDownloadablesCreate::class, BenefitLicenseKeysCreate::class, BenefitMeterCreditCreate::class, BenefitFeatureFlagCreate::class, BenefitSlackSharedChannelCreate::class]);

        if (!$resolved instanceof BenefitCreate) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any BenefitCreate variant.',
            );
        }

        return $resolved;
    }
}