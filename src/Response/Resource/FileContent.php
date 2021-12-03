<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Tuzex\Responder\File\FileData;
use Tuzex\Responder\Http\Charset;
use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\Disposition;
use Tuzex\Responder\Http\HttpHeader\ContentDisposition;
use Tuzex\Responder\Http\HttpHeader\ContentType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\Resource;

abstract class FileContent extends Resource implements Text
{
    private string $content;

    public function __construct(
        FileData $fileData,
        StatusCode $statusCode = StatusCode::OK,
        Disposition $disposition = Disposition::ATTACHMENT,
        Charset $charset = UnicodeCharset::UTF8,
    ) {
        $this->content = $fileData->content;

        $httpHeaders = [
            new ContentType($fileData->info->mime(), $charset),
            new ContentDisposition($disposition, $fileData->info->name),
        ];

        parent::__construct($statusCode, ...$httpHeaders);
    }

    abstract public static function forDownload(string $filename, string $content): self;

    abstract public static function forDisplay(string $filename, string $content): self;

    public function content(): string
    {
        return $this->content;
    }
}
