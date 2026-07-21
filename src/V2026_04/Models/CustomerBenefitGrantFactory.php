<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see CustomerBenefitGrant} variant for a payload.
 *
 * The schema declares no discriminator, so variants are tried in declaration
 * order and the first one that decodes cleanly is returned.
 */
final class CustomerBenefitGrantFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): CustomerBenefitGrant
    {
        $resolved = Union::resolve($data, null, [], [CustomerBenefitGrantDiscord::class, CustomerBenefitGrantGitHubRepository::class, CustomerBenefitGrantDownloadables::class, CustomerBenefitGrantLicenseKeys::class, CustomerBenefitGrantCustom::class, CustomerBenefitGrantMeterCredit::class, CustomerBenefitGrantFeatureFlag::class, CustomerBenefitGrantSlackSharedChannel::class]);

        if (!$resolved instanceof CustomerBenefitGrant) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any CustomerBenefitGrant variant.',
            );
        }

        return $resolved;
    }
}