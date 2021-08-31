<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\Header;

use Tuzex\Responder\Http\HttpHeader;

final class ContentDisposition implements HttpHeader
{
    public const INLINE = 'inline';
    public const ATTACHMENT = 'attachment';

    private string $filename;
    private string $disposition;

    private function __construct(string $filename, string $disposition = self::ATTACHMENT)
    {
        $this->filename = $filename;
        $this->disposition = $disposition;
    }

    public static function inline(string $filename): self
    {
        return new self($filename, self::INLINE);
    }

    public static function attachment(string $filename): self
    {
        return new self($filename, self::ATTACHMENT);
    }

    public function getName(): string
    {
        return 'Content-Disposition';
    }

    public function getValue(): string
    {
        return sprintf('%s; filename="%s"', $this->disposition, $this->filename);
    }

    public function getField(): string
    {
        return sprintf('%s: %s', $this->getName(), $this->getValue());
    }
}
