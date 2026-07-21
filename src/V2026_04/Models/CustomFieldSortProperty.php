<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * CustomFieldSortProperty
 */
enum CustomFieldSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case SLUG = 'slug';
    case SLUG_2 = '-slug';
    case NAME = 'name';
    case NAME_2 = '-name';
    case TYPE = 'type';
    case TYPE_2 = '-type';
}