<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * Benefit
 *
 * Implemented by every variant of this union:
 * - BenefitCustom
 * - BenefitDiscord
 * - BenefitGitHubRepository
 * - BenefitDownloadables
 * - BenefitLicenseKeys
 * - BenefitMeterCredit
 * - BenefitFeatureFlag
 * - BenefitSlackSharedChannel
 *
 * Use {@see BenefitFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface Benefit extends Model
{
}