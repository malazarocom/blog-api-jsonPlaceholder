<?php

namespace App\Shared;

use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;

abstract class Collection implements Countable, IteratorAggregate
{
    public function __construct(
        private array $items
    ) {
        $this->ensureAllItemsAreInstanceOfType($items);
        $this->items = $items;
    }

    abstract protected function type(): string;

    public function count(): int
    {
        return count($this->items());
    }

    public function items(): array
    {
        return $this->items;
    }

    public function add($item): self
    {
        $this->ensureItemIsInstanceOfType($item);

        $this->items[] = $item;

        return $this;
    }

    public function isEmpty(): bool
    {
        return 0 === $this->count();
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items());
    }

    public function getFirst()
    {
        return $this->isEmpty() ? null : $this->items[0];
    }

    private function ensureAllItemsAreInstanceOfType(array $items)
    {
        foreach ($items as $item) {
            $this->ensureItemIsInstanceOfType($item);
        }
    }

    private function ensureItemIsInstanceOfType($item)
    {
        $class = $this->type();
        if (!$item instanceof $class) {
            throw new InvalidArgumentException(sprintf('The item <%s> must be an instance of <%s>', get_class($item), $class));
        }
    }
}
