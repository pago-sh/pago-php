<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * BenefitVisibility
 */
enum BenefitVisibility: string
{
    case DRAFT = 'draft';
    case PRIVATE = 'private';
    case PUBLIC = 'public';
}