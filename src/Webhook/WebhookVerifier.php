<?php

declare(strict_types=1);

namespace Pago\Webhook;

use Pago\Exception\PagoWebhookVerificationException;

/**
 * Standard Webhooks signature verification.
 *
 * The endpoint signing secret is a `whsec_`-prefixed, base64-encoded 32-byte
 * key: the HMAC key is the base64 decoding of everything after the prefix, and
 * *not* the secret string itself. The signed content is
 * `{webhook-id}.{webhook-timestamp}.{body}`, signed with HMAC-SHA256 and
 * encoded as `v1,<base64>`. The `webhook-signature` header may carry several
 * space-separated signatures — any one of them matching accepts the request,
 * which is what makes secret rotation possible.
 */
final class WebhookVerifier
{
    public const TOLERANCE_SECONDS = 5 * 60;

    private const SECRET_PREFIX = 'whsec_';

    /**
     * @param array<string, string> $headers
     *
     * @throws PagoWebhookVerificationException
     */
    public static function verify(string $body, array $headers, string $secret): void
    {
        $key = self::deriveKey($secret);

        $normalized = [];
        foreach ($headers as $name => $value) {
            $normalized[strtolower($name)] = $value;
        }

        $webhookId = $normalized['webhook-id'] ?? '';
        $webhookTimestamp = $normalized['webhook-timestamp'] ?? '';
        $webhookSignature = $normalized['webhook-signature'] ?? '';

        if ($webhookId === '' || $webhookTimestamp === '' || $webhookSignature === '') {
            throw new PagoWebhookVerificationException('Missing required headers');
        }

        if (preg_match('/^-?\d+$/', $webhookTimestamp) !== 1) {
            throw new PagoWebhookVerificationException('Invalid signature headers');
        }

        $timestamp = (int) $webhookTimestamp;
        $now = time();

        if ($timestamp < $now - self::TOLERANCE_SECONDS) {
            throw new PagoWebhookVerificationException('Message timestamp too old');
        }
        if ($timestamp > $now + self::TOLERANCE_SECONDS) {
            throw new PagoWebhookVerificationException('Message timestamp too new');
        }

        $signedContent = $webhookId . '.' . $webhookTimestamp . '.' . $body;
        $expected = hash_hmac('sha256', $signedContent, $key, true);

        $matched = false;
        foreach (explode(' ', $webhookSignature) as $versionedSignature) {
            if ($versionedSignature === '') {
                continue;
            }

            $parts = explode(',', $versionedSignature, 2);
            if (count($parts) !== 2 || $parts[0] !== 'v1') {
                continue;
            }

            $decoded = base64_decode($parts[1], true);
            if ($decoded === false) {
                continue;
            }

            if (hash_equals($expected, $decoded)) {
                $matched = true;
            }
        }

        if (!$matched) {
            throw new PagoWebhookVerificationException('No matching signature found');
        }
    }

    /**
     * Derive the HMAC key from a `whsec_`-prefixed secret.
     *
     * A malformed secret is a configuration error, never a silent verification
     * failure: it is reported distinctly from a signature mismatch so it cannot
     * be mistaken for a forged request.
     *
     * @throws PagoWebhookVerificationException
     */
    private static function deriveKey(string $secret): string
    {
        if ($secret === '') {
            throw new PagoWebhookVerificationException("Secret can't be empty");
        }

        if (!str_starts_with($secret, self::SECRET_PREFIX)) {
            throw new PagoWebhookVerificationException(
                'Invalid webhook secret: expected a secret prefixed with "' . self::SECRET_PREFIX . '"',
            );
        }

        $encoded = substr($secret, strlen(self::SECRET_PREFIX));
        $key = base64_decode($encoded, true);

        if ($key === false || $key === '') {
            throw new PagoWebhookVerificationException(
                'Invalid webhook secret: the value after "' . self::SECRET_PREFIX . '" is not valid base64',
            );
        }

        return $key;
    }
}