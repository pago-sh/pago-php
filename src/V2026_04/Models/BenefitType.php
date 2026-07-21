<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * BenefitType
 */
enum BenefitType: string
{
    case CUSTOM = 'custom';
    case DISCORD = 'discord';
    case GITHUB_REPOSITORY = 'github_repository';
    case DOWNLOADABLES = 'downloadables';
    case LICENSE_KEYS = 'license_keys';
    case METER_CREDIT = 'meter_credit';
    case FEATURE_FLAG = 'feature_flag';
    case SLACK_SHARED_CHANNEL = 'slack_shared_channel';
}