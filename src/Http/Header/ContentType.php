<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Http\Header;

final class ContentType implements Header
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

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
