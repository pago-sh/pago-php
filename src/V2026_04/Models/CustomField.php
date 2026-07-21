<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * CustomField
 *
 * Implemented by every variant of this union:
 * - CustomFieldText
 * - CustomFieldNumber
 * - CustomFieldDate
 * - CustomFieldCheckbox
 * - CustomFieldSelect
 *
 * Use {@see CustomFieldFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface CustomField extends Model
{
}