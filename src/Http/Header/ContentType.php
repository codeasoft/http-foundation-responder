<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\Header;

use Tuzex\Responder\Http\HttpHeader;

final class ContentType implements HttpHeader
{
    public function __construct(
        private string $mimeType,
        private string $charset = 'UTF-8',
    ) {}

    public function getName(): string
    public function name(): string
    {
        return 'Content-Type';
    }

    public function value(): string
    {
        return sprintf('%s; charset=%s', $this->mimeType, $this->charset);
    }

    public function field(): string
    {
        return sprintf('%s: %s', $this->name(), $this->value());
    }
}
