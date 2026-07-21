<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * ProductPriceSource
 */
enum ProductPriceSource: string
{
    case CATALOG = 'catalog';
    case AD_HOC = 'ad_hoc';
}