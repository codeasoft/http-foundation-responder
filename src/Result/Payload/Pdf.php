<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Tuzex\Responder\Http\Header\ContentDisposition;
use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Result\HttpConfig;

final class Pdf extends File
{
    public static function display(string $path, string $name, int $statusCode = StatusCode::OK): self
    {
        return new static($path, $name, HttpConfig::set($statusCode, [
            new ContentType(MimeType::PDF),
            new ContentDisposition($name, ContentDisposition::INLINE),
        ]));
    }

    public static function download(string $path, string $name, int $statusCode = StatusCode::OK): self
    {
        return new static($path, $name, HttpConfig::set($statusCode, [
            new ContentType(MimeType::PDF),
            new ContentDisposition($name, ContentDisposition::ATTACHMENT),
        ]));
    }

    protected function getSuffix(): string
    {
        return '.pdf';
    }
}
