<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * FilterConjunction
 */
enum FilterConjunction: string
{
    case AND = 'and';
    case OR = 'or';
}