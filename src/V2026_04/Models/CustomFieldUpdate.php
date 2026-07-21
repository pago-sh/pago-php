<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * CustomFieldUpdate
 *
 * Implemented by every variant of this union:
 * - CustomFieldUpdateText
 * - CustomFieldUpdateNumber
 * - CustomFieldUpdateDate
 * - CustomFieldUpdateCheckbox
 * - CustomFieldUpdateSelect
 *
 * Use {@see CustomFieldUpdateFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface CustomFieldUpdate extends Model
{
}