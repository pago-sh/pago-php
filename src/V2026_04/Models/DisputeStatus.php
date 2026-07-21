<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * DisputeStatus
 */
enum DisputeStatus: string
{
    case PREVENTED = 'prevented';
    case EARLY_WARNING = 'early_warning';
    case NEEDS_RESPONSE = 'needs_response';
    case UNDER_REVIEW = 'under_review';
    case LOST = 'lost';
    case WON = 'won';
}