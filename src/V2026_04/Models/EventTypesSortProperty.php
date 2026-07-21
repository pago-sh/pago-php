<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * EventTypesSortProperty
 */
enum EventTypesSortProperty: string
{
    case NAME = 'name';
    case NAME_2 = '-name';
    case LABEL = 'label';
    case LABEL_2 = '-label';
    case OCCURRENCES = 'occurrences';
    case OCCURRENCES_2 = '-occurrences';
    case FIRST_SEEN = 'first_seen';
    case FIRST_SEEN_2 = '-first_seen';
    case LAST_SEEN = 'last_seen';
    case LAST_SEEN_2 = '-last_seen';
}