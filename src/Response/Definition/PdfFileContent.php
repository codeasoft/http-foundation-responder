<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Definition;

use Tuzex\Responder\Http\Header\ContentDisposition;
use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Response\HttpConfig;

final class PdfFileContent extends FileContent
{
    public static function defineForDownload(string $content, string $name): self
    {
        $httpConfig = HttpConfig::set(HttpStatusCode::OK, [
            new ContentType(MimeType::PDF),
            new ContentDisposition($name, ContentDisposition::ATTACHMENT),
        ]);

        return new self($content, $name, $httpConfig);
    }

    public static function defineForDisplay(string $content, string $name): self
    {
        $httpConfig = HttpConfig::set(HttpStatusCode::OK, [
            new ContentType(MimeType::PDF),
            new ContentDisposition($name, ContentDisposition::INLINE),
        ]);

        return new self($content, $name, $httpConfig);
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
