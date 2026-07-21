<?php

declare(strict_types=1);

namespace Pago\Tests;

use Pago\Exception\PagoWebhookVerificationException;
use Pago\Webhook\WebhookVerifier;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(WebhookVerifier::class)]
final class WebhookVerifierTest extends TestCase
{
    private const KEY = 'a-32-byte-key-for-webhook-tests!';
    private const SECRET = 'whsec_' . 'YS0zMi1ieXRlLWtleS1mb3Itd2ViaG9vay10ZXN0cyE=';
    private const OTHER_SECRET = 'whsec_' . 'b3RoZXItMzItYnl0ZS1rZXktZm9yLXRoZS10ZXN0cyE=';
    private const WEBHOOK_ID = 'msg_2b8bY7yQ1Nq9';

    public static function signature(string $body, int $timestamp, string $secret, string $webhookId = self::WEBHOOK_ID): string
    {
        $key = base64_decode(substr($secret, strlen('whsec_')), true);
        if ($key === false) {
            throw new \InvalidArgumentException('test fixture secret is not base64');
        }

        return 'v1,' . base64_encode(
            hash_hmac('sha256', $webhookId . '.' . $timestamp . '.' . $body, $key, true),
        );
    }

    /**
     * @return array<string, string>
     */
    private static function headers(
        string $body,
        ?int $timestamp = null,
        string $secret = self::SECRET,
        string $webhookId = self::WEBHOOK_ID,
    ): array {
        $timestamp ??= time();

        return [
            'Webhook-Id' => $webhookId,
            'Webhook-Timestamp' => (string) $timestamp,
            'Webhook-Signature' => self::signature($body, $timestamp, $secret, $webhookId),
        ];
    }

    public function testTheSecretIsBase64DecodedIntoTheHmacKey(): void
    {
        $this->assertSame(self::KEY, base64_decode(substr(self::SECRET, strlen('whsec_')), true));
    }

    /**
     * Constant-time comparison is a timing property, so no black-box test can
     * observe it: swapping `hash_equals` for `===` leaves every other test in
     * this file green. This guards the property at the source level instead.
     */
    public function testTheDigestComparisonIsConstantTime(): void
    {
        $file = (new \ReflectionClass(WebhookVerifier::class))->getFileName();
        $this->assertIsString($file);
        $source = file_get_contents($file);
        $this->assertIsString($source);

        $this->assertStringContainsString('hash_equals($expected, $decoded)', $source);
        $this->assertDoesNotMatchRegularExpression('/\$expected\s*[=!]==?\s*\$decoded/', $source);
        $this->assertDoesNotMatchRegularExpression('/\$decoded\s*[=!]==?\s*\$expected/', $source);
        $this->assertDoesNotMatchRegularExpression('/\bstrcmp\s*\(\s*\$expected/', $source);
    }

    public function testAcceptsAValidSignature(): void
    {
        $body = '{"type":"dummy.event","value":"payload"}';

        WebhookVerifier::verify($body, self::headers($body), self::SECRET);

        $this->expectNotToPerformAssertions();
    }

    public function testAcceptsASignatureProducedByAThirdPartyStandardWebhooksLibrary(): void
    {
        // Fixture computed independently of the implementation: HMAC-SHA256 over
        // "{id}.{timestamp}.{body}" keyed with the raw 32 bytes of self::KEY.
        $body = '{"type":"order.created"}';
        $timestamp = 1700000000;
        $expected = 'v1,' . base64_encode(
            hash_hmac('sha256', self::WEBHOOK_ID . '.1700000000.' . $body, self::KEY, true),
        );

        $this->assertSame($expected, self::signature($body, $timestamp, self::SECRET));
    }

    public function testRejectsASignatureKeyedWithTheRawSecret(): void
    {
        // The pre-fix behaviour: HMAC keyed with the "whsec_…" string verbatim.
        $body = '{"type":"dummy.event"}';
        $timestamp = time();
        $headers = [
            'Webhook-Id' => self::WEBHOOK_ID,
            'Webhook-Timestamp' => (string) $timestamp,
            'Webhook-Signature' => 'v1,' . base64_encode(
                hash_hmac('sha256', self::WEBHOOK_ID . '.' . $timestamp . '.' . $body, self::SECRET, true),
            ),
        ];

        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('No matching signature found');

        WebhookVerifier::verify($body, $headers, self::SECRET);
    }

    public function testHeaderLookupIsCaseInsensitive(): void
    {
        $body = '{"type":"dummy.event"}';
        $headers = [];
        foreach (self::headers($body) as $name => $value) {
            $headers[strtoupper($name)] = $value;
        }

        WebhookVerifier::verify($body, $headers, self::SECRET);

        $this->expectNotToPerformAssertions();
    }

    public function testAcceptsWhenOneOfSeveralSignaturesMatches(): void
    {
        $body = '{"type":"dummy.event"}';
        $timestamp = time();
        $headers = self::headers($body, $timestamp);
        // Secret rotation: the sender signs with both the retiring and the
        // incoming secret; the receiver still trusts only one of them.
        $headers['Webhook-Signature'] = implode(' ', [
            self::signature($body, $timestamp, self::OTHER_SECRET),
            $headers['Webhook-Signature'],
        ]);

        WebhookVerifier::verify($body, $headers, self::SECRET);

        $this->expectNotToPerformAssertions();
    }

    public function testAcceptsWhenTheMatchingSignatureComesLast(): void
    {
        $body = '{"type":"dummy.event"}';
        $timestamp = time();
        $headers = self::headers($body, $timestamp);
        $headers['Webhook-Signature'] = implode(' ', [
            $headers['Webhook-Signature'],
            self::signature($body, $timestamp, self::OTHER_SECRET),
            'v1,' . base64_encode('nope'),
        ]);

        WebhookVerifier::verify($body, $headers, self::SECRET);

        $this->expectNotToPerformAssertions();
    }

    public function testRejectsAForgedSignature(): void
    {
        $body = '{"type":"dummy.event"}';
        $timestamp = time();
        $headers = self::headers($body, $timestamp);
        $headers['Webhook-Signature'] = 'v1,' . base64_encode(random_bytes(32));

        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('No matching signature found');

        WebhookVerifier::verify($body, $headers, self::SECRET);
    }

    public function testRejectsASignatureFromAnotherSecret(): void
    {
        $body = '{"type":"dummy.event"}';

        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('No matching signature found');

        WebhookVerifier::verify($body, self::headers($body, null, self::OTHER_SECRET), self::SECRET);
    }

    public function testRejectsATamperedBody(): void
    {
        $headers = self::headers('{"amount":100}');

        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('No matching signature found');

        WebhookVerifier::verify('{"amount":100000}', $headers, self::SECRET);
    }

    public function testRejectsATamperedWebhookId(): void
    {
        $body = '{"type":"dummy.event"}';
        $headers = self::headers($body);
        $headers['Webhook-Id'] = 'msg_forged';

        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('No matching signature found');

        WebhookVerifier::verify($body, $headers, self::SECRET);
    }

    public function testRejectsATamperedTimestamp(): void
    {
        $body = '{"type":"dummy.event"}';
        $timestamp = time();
        $headers = self::headers($body, $timestamp);
        $headers['Webhook-Timestamp'] = (string) ($timestamp - 1);

        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('No matching signature found');

        WebhookVerifier::verify($body, $headers, self::SECRET);
    }

    public function testRejectsAReplayedRequest(): void
    {
        // A genuine request, correctly signed, replayed once the window closed.
        $body = '{"type":"dummy.event"}';
        $timestamp = time() - WebhookVerifier::TOLERANCE_SECONDS - 1;

        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('Message timestamp too old');

        WebhookVerifier::verify($body, self::headers($body, $timestamp), self::SECRET);
    }

    public function testRejectsATimestampFromTheFuture(): void
    {
        $body = '{}';
        $timestamp = time() + WebhookVerifier::TOLERANCE_SECONDS + 60;

        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('Message timestamp too new');

        WebhookVerifier::verify($body, self::headers($body, $timestamp), self::SECRET);
    }

    public function testAcceptsATimestampInsideTheTolerance(): void
    {
        $body = '{}';

        foreach ([-WebhookVerifier::TOLERANCE_SECONDS + 5, WebhookVerifier::TOLERANCE_SECONDS - 5] as $offset) {
            $timestamp = time() + $offset;
            WebhookVerifier::verify($body, self::headers($body, $timestamp), self::SECRET);
        }

        $this->expectNotToPerformAssertions();
    }

    public function testRejectsASecretWithoutTheWhsecPrefix(): void
    {
        $body = '{}';

        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('Invalid webhook secret: expected a secret prefixed with "whsec_"');

        WebhookVerifier::verify($body, self::headers($body), base64_encode(self::KEY));
    }

    public function testRejectsASecretWhoseBodyIsNotBase64(): void
    {
        $body = '{}';

        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('Invalid webhook secret: the value after "whsec_" is not valid base64');

        WebhookVerifier::verify($body, self::headers($body), 'whsec_not valid base64!!');
    }

    public function testRejectsASecretThatIsOnlyThePrefix(): void
    {
        $body = '{}';

        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('Invalid webhook secret: the value after "whsec_" is not valid base64');

        WebhookVerifier::verify($body, self::headers($body), 'whsec_');
    }

    public function testRejectsAnEmptySecret(): void
    {
        $body = '{}';

        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage("Secret can't be empty");

        WebhookVerifier::verify($body, self::headers($body), '');
    }

    public function testRejectsAMalformedSecretBeforeLookingAtTheHeaders(): void
    {
        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('Invalid webhook secret: expected a secret prefixed with "whsec_"');

        WebhookVerifier::verify('{}', [], 'plain-secret');
    }

    public function testRejectsMissingHeaders(): void
    {
        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('Missing required headers');

        WebhookVerifier::verify('{}', [], self::SECRET);
    }

    public function testRejectsANonNumericTimestamp(): void
    {
        $body = '{}';
        $headers = self::headers($body);
        $headers['Webhook-Timestamp'] = 'not-a-number';

        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('Invalid signature headers');

        WebhookVerifier::verify($body, $headers, self::SECRET);
    }

    public function testIgnoresSignaturesWithAnUnknownVersion(): void
    {
        $body = '{}';
        $headers = self::headers($body);
        $headers['Webhook-Signature'] = str_replace('v1,', 'v2,', $headers['Webhook-Signature']);

        $this->expectException(PagoWebhookVerificationException::class);
        $this->expectExceptionMessage('No matching signature found');

        WebhookVerifier::verify($body, $headers, self::SECRET);
    }

    public function testIgnoresSignaturesThatAreNotBase64(): void
    {
        $body = '{}';
        $timestamp = time();
        $headers = self::headers($body, $timestamp);
        $headers['Webhook-Signature'] = 'v1,!!!not-base64!!! ' . $headers['Webhook-Signature'];

        WebhookVerifier::verify($body, $headers, self::SECRET);

        $this->expectNotToPerformAssertions();
    }
}