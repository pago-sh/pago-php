<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

/**
 * FileServiceTypes
 */
enum FileServiceTypes: string
{
    case DOWNLOADABLE = 'downloadable';
    case PRODUCT_MEDIA = 'product_media';
    case ORGANIZATION_AVATAR = 'organization_avatar';
    case SUPPORT_CASE_ATTACHMENT = 'support_case_attachment';
}