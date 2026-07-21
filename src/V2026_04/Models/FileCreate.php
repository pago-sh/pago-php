<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Model;

/**
 * FileCreate
 *
 * Implemented by every variant of this union:
 * - DownloadableFileCreate
 * - ProductMediaFileCreate
 * - OrganizationAvatarFileCreate
 * - SupportCaseAttachmentFileCreate
 *
 * Use {@see FileCreateFactory::fromArray()} to build the right variant
 * from a decoded payload.
 */
interface FileCreate extends Model
{
}