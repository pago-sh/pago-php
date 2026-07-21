<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * CustomFieldCreate
 *
 * Implemented by every variant of this union:
 * - CustomFieldCreateText
 * - CustomFieldCreateNumber
 * - CustomFieldCreateDate
 * - CustomFieldCreateCheckbox
 * - CustomFieldCreateSelect
 *
 * Use {@see CustomFieldCreateFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface CustomFieldCreate extends Model
{
}