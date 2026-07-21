<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see Benefit} variant for a payload.
 *
 * Dispatch is driven by the `type` discriminator property.
 */
final class BenefitFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): Benefit
    {
        $resolved = Union::resolve($data, 'type', ['custom' => BenefitCustom::class, 'discord' => BenefitDiscord::class, 'downloadables' => BenefitDownloadables::class, 'feature_flag' => BenefitFeatureFlag::class, 'github_repository' => BenefitGitHubRepository::class, 'license_keys' => BenefitLicenseKeys::class, 'meter_credit' => BenefitMeterCredit::class, 'slack_shared_channel' => BenefitSlackSharedChannel::class], [BenefitCustom::class, BenefitDiscord::class, BenefitGitHubRepository::class, BenefitDownloadables::class, BenefitLicenseKeys::class, BenefitMeterCredit::class, BenefitFeatureFlag::class, BenefitSlackSharedChannel::class]);

        if (!$resolved instanceof Benefit) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any Benefit variant.',
            );
        }

        return $resolved;
    }
}