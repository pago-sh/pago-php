<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * BenefitGrantWebhook
 *
 * Implemented by every variant of this union:
 * - BenefitGrantDiscordWebhook
 * - BenefitGrantCustomWebhook
 * - BenefitGrantGitHubRepositoryWebhook
 * - BenefitGrantDownloadablesWebhook
 * - BenefitGrantLicenseKeysWebhook
 * - BenefitGrantMeterCreditWebhook
 * - BenefitGrantFeatureFlagWebhook
 * - BenefitGrantSlackSharedChannelWebhook
 *
 * Use {@see BenefitGrantWebhookFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface BenefitGrantWebhook extends Model
{
}