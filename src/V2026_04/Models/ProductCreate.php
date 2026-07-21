<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * ProductCreate
 *
 * Implemented by every variant of this union:
 * - ProductCreateRecurring
 * - ProductCreateOneTime
 *
 * Use {@see ProductCreateFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface ProductCreate extends Model
{
}