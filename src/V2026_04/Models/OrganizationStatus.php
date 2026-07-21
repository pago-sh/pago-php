<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * OrganizationStatus
 */
enum OrganizationStatus: string
{
    case CREATED = 'created';
    case REVIEW = 'review';
    case SNOOZED = 'snoozed';
    case DENIED = 'denied';
    case ACTIVE = 'active';
    case BLOCKED = 'blocked';
    case OFFBOARDING = 'offboarding';
    case OFFBOARDED = 'offboarded';
}