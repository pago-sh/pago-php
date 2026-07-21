<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * Event
 *
 * Implemented by every variant of this union:
 * - SystemEvent
 * - UserEvent
 *
 * Use {@see EventFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface Event extends Model
{
}