<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * CustomFieldType
 */
enum CustomFieldType: string
{
    case TEXT = 'text';
    case NUMBER = 'number';
    case DATE = 'date';
    case CHECKBOX = 'checkbox';
    case SELECT = 'select';
}