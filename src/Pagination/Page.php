<?php

declare(strict_types=1);

namespace Pago\Pagination;

use Closure;
use Generator;
use IteratorAggregate;

/**
 * Lazily walks a `page`/`limit` paginated endpoint.
 *
 * Pages are fetched on demand while iterating, so `foreach` over the whole
 * result set only performs as many requests as the consumer actually needs.
 *
 * @template T
 *
 * @implements IteratorAggregate<int, T>
 */
final class Page implements IteratorAggregate
{
    /**
     * @param Closure(int): array{0: list<T>, 1: int} $fetcher returns the page items and the last page number
     */
    public function __construct(
        private readonly Closure $fetcher,
        private readonly int $startPage = 1,
    ) {
    }

    /**
     * @return Generator<int, T>
     */
    public function getIterator(): Generator
    {
        $page = $this->startPage;
        $index = 0;

        while (true) {
            [$items, $maxPage] = ($this->fetcher)($page);

            foreach ($items as $item) {
                yield $index => $item;
                $index++;
            }

            if ($page >= $maxPage) {
                return;
            }

            $page++;
        }
    }

    /**
     * Eagerly collect every item across every page.
     *
     * @return list<T>
     */
    public function toList(): array
    {
        return iterator_to_array($this, false);
    }
}