<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * CustomerCreate
 *
 * Implemented by every variant of this union:
 * - CustomerIndividualCreate
 * - CustomerTeamCreate
 *
 * Use {@see CustomerCreateFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface CustomerCreate extends Model
{
}