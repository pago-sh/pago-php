<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * MemberRole
 */
enum MemberRole: string
{
    case OWNER = 'owner';
    case BILLING_MANAGER = 'billing_manager';
    case MEMBER = 'member';
}