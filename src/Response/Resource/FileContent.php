<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Tuzex\Responder\File\FileFormat;
use Tuzex\Responder\Http\Charset;
use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\Disposition;
use Tuzex\Responder\Http\HttpHeader\ContentDispositionHttpHeader;
use Tuzex\Responder\Http\HttpHeader\ContentTypeHttpHeader;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\Resource;
use Webmozart\Assert\Assert;

abstract class FileContent extends Resource implements Text
{
    final public function __construct(
        public readonly string $filename,
        public readonly string $content,
        StatusCode $statusCode = StatusCode::OK,
        Disposition $disposition = Disposition::ATTACHMENT,
        Charset $charset = UnicodeCharset::UTF8,
    ) {
        Assert::endsWith($this->filename, $this->fileFormat()->extension());

        $httpHeaders = [
            new ContentTypeHttpHeader($this->mimeType(), $charset),
            new ContentDispositionHttpHeader($disposition, $this->filename),
        ];

        parent::__construct($statusCode, ...$httpHeaders);
    }

    public static function forDownload(string $filename, string $content): static
    {
        return new static(
            filename: $filename,
            content: $content,
            disposition: Disposition::ATTACHMENT,
        );
    }

    public static function forDisplay(string $filename, string $content): static
    {
        return new static(
            filename: $filename,
            content: $content,
            disposition: Disposition::INLINE,
        );
    }

    public function content(): string
    {
        return $this->content;
    }

    abstract protected function fileFormat(): FileFormat;

    abstract protected function mimeType(): MimeType;
}
