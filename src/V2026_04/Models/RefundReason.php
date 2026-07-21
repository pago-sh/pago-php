<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * RefundReason
 */
enum RefundReason: string
{
    case DUPLICATE = 'duplicate';
    case FRAUDULENT = 'fraudulent';
    case CUSTOMER_REQUEST = 'customer_request';
    case SERVICE_DISRUPTION = 'service_disruption';
    case SATISFACTION_GUARANTEE = 'satisfaction_guarantee';
    case DISPUTE_PREVENTION = 'dispute_prevention';
    case OTHER = 'other';
}