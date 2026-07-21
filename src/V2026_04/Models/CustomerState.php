<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * CustomerState
 *
 * Implemented by every variant of this union:
 * - CustomerStateIndividual
 * - CustomerStateTeam
 *
 * Use {@see CustomerStateFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface CustomerState extends Model
{
}