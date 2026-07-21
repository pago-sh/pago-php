<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * ProductVisibility
 */
enum ProductVisibility: string
{
    case DRAFT = 'draft';
    case PRIVATE = 'private';
    case PUBLIC = 'public';
}