<?php

declare(strict_types=1);

namespace Pago\Tests;

use Pago\Pagination\Page;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Page::class)]
final class PageTest extends TestCase
{
    public function testIteratesEveryPageInOrder(): void
    {
        /** @var Page<string> $page */
        $page = new Page(static fn (int $page): array => [
            ['item-' . $page . 'a', 'item-' . $page . 'b'],
            3,
        ]);

        self::assertSame(
            ['item-1a', 'item-1b', 'item-2a', 'item-2b', 'item-3a', 'item-3b'],
            $page->toList(),
        );
    }

    public function testFetchesLazily(): void
    {
        $fetched = [];

        /** @var Page<int> $page */
        $page = new Page(static function (int $page) use (&$fetched): array {
            $fetched[] = $page;

            return [[$page * 10], 100];
        });

        $iterator = $page->getIterator();
        $iterator->rewind();

        self::assertSame(10, $iterator->current());
        self::assertSame([1], $fetched);

        $iterator->next();

        self::assertSame(20, $iterator->current());
        self::assertSame([1, 2], $fetched);
    }

    public function testStopsOnASinglePage(): void
    {
        $calls = 0;

        /** @var Page<string> $page */
        $page = new Page(static function (int $page) use (&$calls): array {
            $calls++;

            return [['only'], 1];
        });

        self::assertSame(['only'], $page->toList());
        self::assertSame(1, $calls);
    }

    public function testKeysAreSequentialAcrossPages(): void
    {
        /** @var Page<string> $page */
        $page = new Page(static fn (int $page): array => [['a', 'b'], 2]);

        self::assertSame([0, 1, 2, 3], array_keys(iterator_to_array($page)));
    }
}