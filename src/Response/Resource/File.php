<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Tuzex\Responder\File\FileExtension;
use Tuzex\Responder\Http\Charset;
use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\Disposition;
use Tuzex\Responder\Http\HttpHeader\ContentDispositionHttpHeader;
use Tuzex\Responder\Http\HttpHeader\ContentTypeHttpHeader;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\Resource;
use Webmozart\Assert\Assert;

abstract class File extends Resource
{
    final public function __construct(
        public readonly string $filepath,
        public readonly string $filename,
        StatusCode $statusCode = StatusCode::OK,
        Disposition $disposition = Disposition::ATTACHMENT,
        Charset $charset = UnicodeCharset::UTF8,
    ) {
        Assert::allEndsWith([
            $this->filepath,
            $this->filename,
        ], $this->fileExtension()->value());

        $httpHeaders = [
            new ContentTypeHttpHeader($this->mimeType(), $charset),
            new ContentDispositionHttpHeader($disposition, $this->filename),
        ];

        parent::__construct($statusCode, ...$httpHeaders);
    }

    public static function forDownload(string $filepath): static
    {
        return new static(
            filepath: $filepath,
            filename: $filepath,
            disposition: Disposition::ATTACHMENT,
        );
    }

    public static function forNamedDownload(string $filepath, string $filename): static
    {
        return new static(
            filepath: $filepath,
            filename: $filename,
            disposition: Disposition::ATTACHMENT,
        );
    }

    public static function forDisplay(string $filepath): static
    {
        return new static(
            filepath: $filepath,
            filename: $filepath,
            disposition: Disposition::INLINE,
        );
    }

    public static function forNamedDisplay(string $filepath, string $filename): static
    {
        return new static(
            filepath: $filepath,
            filename: $filename,
            disposition: Disposition::INLINE,
        );
    }

    abstract protected function fileExtension(): FileExtension;

    abstract protected function mimeType(): MimeType;
}
