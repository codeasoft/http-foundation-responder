<?php

declare(strict_types=1);

namespace Codea\Responder\Response\Resource;

use Codea\Responder\File\FileExtension;
use Codea\Responder\Http\Charset;
use Codea\Responder\Http\Charset\UnicodeCharset;
use Codea\Responder\Http\Disposition;
use Codea\Responder\Http\HttpHeader\ContentDispositionHttpHeader;
use Codea\Responder\Http\HttpHeader\ContentTypeHttpHeader;
use Codea\Responder\Http\MimeType;
use Codea\Responder\Http\StatusCode;
use Codea\Responder\Response\Resource;
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
        Assert::endsWith(
            $this->filename,
            $this->fileExtension()->value()
        );

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

    abstract protected function fileExtension(): FileExtension;

    abstract protected function mimeType(): MimeType;
}
