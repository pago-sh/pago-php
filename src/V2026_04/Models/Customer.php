<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * Customer
 *
 * Implemented by every variant of this union:
 * - CustomerIndividual
 * - CustomerTeam
 *
 * Use {@see CustomerFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface Customer extends Model
{
}