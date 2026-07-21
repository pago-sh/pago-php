<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * CheckoutLinkSortProperty
 */
enum CheckoutLinkSortProperty: string
{
    case CREATED_AT = 'created_at';
    case CREATED_AT_2 = '-created_at';
    case LABEL = 'label';
    case LABEL_2 = '-label';
    case SUCCESS_URL = 'success_url';
    case SUCCESS_URL_2 = '-success_url';
    case ALLOW_DISCOUNT_CODES = 'allow_discount_codes';
    case ALLOW_DISCOUNT_CODES_2 = '-allow_discount_codes';
}