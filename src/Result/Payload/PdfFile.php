<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Tuzex\Responder\Http\Header\ContentDisposition;
use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Result\HttpConfig;

final class PdfFile extends File
{
    public static function download(string $path, string $name, int $statusCode = HttpStatusCode::OK): self
    {
        $httpConfig = HttpConfig::set($statusCode, [
            new ContentType(MimeType::PDF),
            new ContentDisposition($name, ContentDisposition::ATTACHMENT),
        ]);

        return new self($path, $name, $httpConfig);
    }
    public static function display(string $path, string $name, int $statusCode = HttpStatusCode::OK): self
    {
        $httpConfig = HttpConfig::set($statusCode, [
            new ContentType(MimeType::PDF),
            new ContentDisposition($name, ContentDisposition::INLINE),
        ]);

        return new self($path, $name, $httpConfig);
    }

    public function mimeType(): string
    {
        return MimeType::PDF;
    }

    protected function extension(): string
    {
        return '.pdf';
    }
}
