<?php

declare(strict_types=1);

namespace Codea\Responder\Response;

use Iterator;

final class FlashMessageBag implements Iterator
{
    private array $messages = [];

    private int $pointer = 0;

    public function __construct(FlashMessage ...$messages)
    {
        $this->messages = $messages;
    }

    public function current(): FlashMessage
    {
        return $this->messages[$this->pointer];
    }

    public function next(): void
    {
        ++$this->pointer;
    }

    public function key(): int
    {
        return $this->pointer;
    }

    public function valid(): bool
    {
        return array_key_exists($this->pointer, $this->messages);
    }

    public function rewind(): void
    {
        $this->pointer = 0;
    }

    public function push(FlashMessage ...$messages): self
    {
        return new self(...array_values(array_merge($this->messages, $messages)));
    }
}
