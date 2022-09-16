<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\Resource;

use Codea\SmartReply\File\FileExtension;
use Codea\SmartReply\Http\Charset;
use Codea\SmartReply\Http\Charset\UnicodeCharset;
use Codea\SmartReply\Http\Disposition;
use Codea\SmartReply\Http\HttpHeader\ContentDispositionHttpHeader;
use Codea\SmartReply\Http\HttpHeader\ContentTypeHttpHeader;
use Codea\SmartReply\Http\MimeType;
use Codea\SmartReply\Http\StatusCode;
use Codea\SmartReply\Response\Resource;
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
