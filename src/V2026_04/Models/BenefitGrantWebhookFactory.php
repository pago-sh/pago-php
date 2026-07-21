<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see BenefitGrantWebhook} variant for a payload.
 *
 * The schema declares no discriminator, so variants are tried in declaration
 * order and the first one that decodes cleanly is returned.
 */
final class BenefitGrantWebhookFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): BenefitGrantWebhook
    {
        $resolved = Union::resolve($data, null, [], [BenefitGrantDiscordWebhook::class, BenefitGrantCustomWebhook::class, BenefitGrantGitHubRepositoryWebhook::class, BenefitGrantDownloadablesWebhook::class, BenefitGrantLicenseKeysWebhook::class, BenefitGrantMeterCreditWebhook::class, BenefitGrantFeatureFlagWebhook::class, BenefitGrantSlackSharedChannelWebhook::class]);

        if (!$resolved instanceof BenefitGrantWebhook) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any BenefitGrantWebhook variant.',
            );
        }

        return $resolved;
    }
}