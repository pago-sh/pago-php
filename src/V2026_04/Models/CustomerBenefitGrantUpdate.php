<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * CustomerBenefitGrantUpdate
 *
 * Implemented by every variant of this union:
 * - CustomerBenefitGrantDiscordUpdate
 * - CustomerBenefitGrantGitHubRepositoryUpdate
 * - CustomerBenefitGrantDownloadablesUpdate
 * - CustomerBenefitGrantLicenseKeysUpdate
 * - CustomerBenefitGrantCustomUpdate
 * - CustomerBenefitGrantMeterCreditUpdate
 * - CustomerBenefitGrantFeatureFlagUpdate
 * - CustomerBenefitGrantSlackSharedChannelUpdate
 *
 * Use {@see CustomerBenefitGrantUpdateFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface CustomerBenefitGrantUpdate extends Model
{
}