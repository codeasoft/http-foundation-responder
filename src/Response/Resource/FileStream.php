<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource;

use Closure;
use Termyn\SmartReply\File\FileExtension;
use Termyn\SmartReply\Http\Charset;
use Termyn\SmartReply\Http\Charset\UnicodeCharset;
use Termyn\SmartReply\Http\Disposition;
use Termyn\SmartReply\Http\HttpHeader\ContentDispositionHttpHeader;
use Termyn\SmartReply\Http\HttpHeader\ContentTypeHttpHeader;
use Termyn\SmartReply\Http\MimeType;
use Termyn\SmartReply\Http\StatusCode;
use Termyn\SmartReply\Response\Resource;
use Webmozart\Assert\Assert;

abstract class FileStream extends Resource implements Stream
{
    final public function __construct(
        public readonly string $filename,
        public readonly Closure $callback,
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

    public static function forDownload(string $filename, Closure $callback): static
    {
        return new static(
            filename: $filename,
            callback: $callback,
            disposition: Disposition::ATTACHMENT,
        );
    }

    public static function forDisplay(string $filename, Closure $callback): static
    {
        return new static(
            filename: $filename,
            callback: $callback,
            disposition: Disposition::INLINE,
        );
    }

    public function callback(): Closure
    {
        return $this->callback;
    }

    abstract protected function fileExtension(): FileExtension;

    abstract protected function mimeType(): MimeType;
}
