<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Stream;

use Tuzex\Symfony\Responder\Http\Header\ContentDisposition;
use Tuzex\Symfony\Responder\Http\Header\ContentType;
use Tuzex\Symfony\Responder\Http\MimeType;
use Tuzex\Symfony\Responder\Http\StatusCode;
use Tuzex\Symfony\Responder\Result\HttpConfigs;

final class PdfFile extends File
{
    public static function initForDisplay(string $path, string $name, int $statusCode = StatusCode::OK): self
    {
        return new static($path, $name, HttpConfigs::set($statusCode, [
            new ContentType(MimeType::PDF),
            new ContentDisposition($name, ContentDisposition::INLINE),
        ]));
    }

    public static function initToDownload(string $path, string $name, int $statusCode = StatusCode::OK): self
    {
        return new static($path, $name, HttpConfigs::set($statusCode, [
            new ContentType(MimeType::PDF),
            new ContentDisposition($name, ContentDisposition::ATTACHMENT),
        ]));
    }

    public function getSuffix(): string
    {
        return '.pdf';
    }
}
