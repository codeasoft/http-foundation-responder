<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Http\Header;

final class ContentDisposition implements Header
{
    public const INLINE = 'inline';
    public const ATTACHMENT = 'attachment';

    private string $filename;
    private string $disposition;

    public function __construct(string $filename, string $disposition = self::ATTACHMENT)
    {
        $this->filename = $filename;
        $this->disposition = $disposition;
    }

    public static function inline(string $filename): self
    {
        return new self(self::INLINE, $filename);
    }

    public static function attachment(string $filename): self
    {
        return new self(self::ATTACHMENT, $filename);
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
