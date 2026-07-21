<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * The role of the member within the customer. To assign or transfer ownership, use the member update endpoint.
 */
enum Role: string
{
    case MEMBER = 'member';
    case BILLING_MANAGER = 'billing_manager';
}