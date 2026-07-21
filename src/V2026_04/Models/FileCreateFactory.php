<?php

declare(strict_types=1);

namespace Pago\V2026_04\Models;

use Pago\Contracts\Deserializable;
use Pago\Serialization\Union;

/**
 * Builds the concrete {@see FileCreate} variant for a payload.
 *
 * Dispatch is driven by the `service` discriminator property.
 */
final class FileCreateFactory implements Deserializable
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): FileCreate
    {
        $resolved = Union::resolve($data, 'service', ['downloadable' => DownloadableFileCreate::class, 'organization_avatar' => OrganizationAvatarFileCreate::class, 'product_media' => ProductMediaFileCreate::class, 'support_case_attachment' => SupportCaseAttachmentFileCreate::class], [DownloadableFileCreate::class, ProductMediaFileCreate::class, OrganizationAvatarFileCreate::class, SupportCaseAttachmentFileCreate::class]);

        if (!$resolved instanceof FileCreate) {
            throw new \Pago\Exception\PagoSerializationException(
                'Payload does not match any FileCreate variant.',
            );
        }

        return $resolved;
    }
}