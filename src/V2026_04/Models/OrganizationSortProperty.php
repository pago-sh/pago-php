<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * OrganizationSortProperty
 */
enum OrganizationSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case SLUG = 'slug';
    case SLUG_2 = '-slug';
    case NAME = 'name';
    case NAME_2 = '-name';
    case NEXT_REVIEW_THRESHOLD = 'next_review_threshold';
    case NEXT_REVIEW_THRESHOLD_2 = '-next_review_threshold';
    case DAYS_IN_STATUS = 'days_in_status';
    case DAYS_IN_STATUS_2 = '-days_in_status';
}