<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Tuzex\Responder\File\FileInfo;
use Tuzex\Responder\Http\Charset;
use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\Disposition;
use Tuzex\Responder\Http\HttpHeader\ContentDisposition;
use Tuzex\Responder\Http\HttpHeader\ContentType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\Resource;

abstract class File extends Resource
{
    public readonly string $pathname;

    public function __construct(
        FileInfo $fileInfo,
        StatusCode $statusCode = StatusCode::OK,
        Disposition $disposition = Disposition::ATTACHMENT,
        Charset $charset = UnicodeCharset::UTF8,
    ) {
        $this->pathname = $fileInfo->path;

        $httpHeaders = [
            new ContentType($fileInfo->mime(), $charset),
            new ContentDisposition($disposition, $fileInfo->name),
        ];

        parent::__construct($statusCode, ...$httpHeaders);
    }

    abstract public static function forDownload(string $filepath, string $filename): self;

    abstract public static function forDisplay(string $filepath, string $filename): self;
}
