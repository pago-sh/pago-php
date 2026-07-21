<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * BillingAddressFieldMode
 */
enum BillingAddressFieldMode: string
{
    case REQUIRED = 'required';
    case OPTIONAL = 'optional';
    case DISABLED = 'disabled';
}