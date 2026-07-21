<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * OrderStatus
 */
enum OrderStatus: string
{
    case DRAFT = 'draft';
    case PENDING = 'pending';
    case PAID = 'paid';
    case REFUNDED = 'refunded';
    case PARTIALLY_REFUNDED = 'partially_refunded';
    case VOID_ = 'void';
}