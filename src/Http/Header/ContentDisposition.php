<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\Header;

use Tuzex\Responder\Http\HttpHeader;

final class ContentDisposition implements HttpHeader
{
    public const INLINE = 'inline';
    public const ATTACHMENT = 'attachment';

    private function __construct(
        private string $filename,
        private string $disposition = self::ATTACHMENT
    ) {}

    public static function inline(string $filename): self
    {
        return new self($filename, self::INLINE);
    }

    public static function attachment(string $filename): self
    {
        return new self($filename, self::ATTACHMENT);
    }

    public function name(): string
    {
        return 'Content-Disposition';
    }

    public function value(): string
    {
        return sprintf('%s; filename="%s"', $this->disposition, $this->filename);
    }

    public function field(): string
    {
        return sprintf('%s: %s', $this->name(), $this->value());
    }
}
