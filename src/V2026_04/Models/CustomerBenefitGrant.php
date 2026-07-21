<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * CustomerBenefitGrant
 *
 * Implemented by every variant of this union:
 * - CustomerBenefitGrantDiscord
 * - CustomerBenefitGrantGitHubRepository
 * - CustomerBenefitGrantDownloadables
 * - CustomerBenefitGrantLicenseKeys
 * - CustomerBenefitGrantCustom
 * - CustomerBenefitGrantMeterCredit
 * - CustomerBenefitGrantFeatureFlag
 * - CustomerBenefitGrantSlackSharedChannel
 *
 * Use {@see CustomerBenefitGrantFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface CustomerBenefitGrant extends Model
{
}