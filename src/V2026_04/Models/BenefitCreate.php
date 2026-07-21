<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * BenefitCreate
 *
 * Implemented by every variant of this union:
 * - BenefitCustomCreate
 * - BenefitDiscordCreate
 * - BenefitGitHubRepositoryCreate
 * - BenefitDownloadablesCreate
 * - BenefitLicenseKeysCreate
 * - BenefitMeterCreditCreate
 * - BenefitFeatureFlagCreate
 * - BenefitSlackSharedChannelCreate
 *
 * Use {@see BenefitCreateFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface BenefitCreate extends Model
{
}