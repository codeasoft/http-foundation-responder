<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\Header;

use Tuzex\Responder\Http\Header;

final class ContentType implements Header
{
    public function __construct(
        private string $value,
    ) {}

    public function getName(): string
    {
        return 'Content-Type';
    }

    public function getValue(): string
    {
        return sprintf('%s; charset=UTF-8', $this->value);
    }

    public function getField(): string
    {
        return sprintf('%s: %s', $this->getName(), $this->getValue());
    }
}
