<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * FileRead
 *
 * Implemented by every variant of this union:
 * - DownloadableFileRead
 * - ProductMediaFileRead
 * - OrganizationAvatarFileRead
 * - SupportCaseAttachmentFileRead
 *
 * Use {@see FileReadFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface FileRead extends Model
{
}