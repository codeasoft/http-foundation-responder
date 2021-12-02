<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\HttpHeader;

use Tuzex\Responder\Http\HttpHeader;

abstract class ContentType implements HttpHeader
{
    public function name(): string
    {
        return 'Content-Type';
    }

    public function field(): string
    {
        return sprintf('%s: %s', $this->name(), $this->value());
    }

    abstract public function value(): string;
}
