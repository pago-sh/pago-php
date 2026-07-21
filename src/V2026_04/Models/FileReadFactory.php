<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see FileRead} variant for a payload.
 *
 * Dispatch is driven by the `service` discriminator property.
 */
final class FileReadFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): FileRead
    {
        $resolved = Union::resolve($data, 'service', ['downloadable' => DownloadableFileRead::class, 'organization_avatar' => OrganizationAvatarFileRead::class, 'product_media' => ProductMediaFileRead::class, 'support_case_attachment' => SupportCaseAttachmentFileRead::class], [DownloadableFileRead::class, ProductMediaFileRead::class, OrganizationAvatarFileRead::class, SupportCaseAttachmentFileRead::class]);

        if (!$resolved instanceof FileRead) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any FileRead variant.',
            );
        }

        return $resolved;
    }
}