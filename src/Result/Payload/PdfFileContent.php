<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Tuzex\Responder\Http\Header\ContentDisposition;
use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Result\HttpConfig;

final class PdfFileContent extends FileContent
{
    public static function display(string $fileContent, string $fileName, int $statusCode = HttpStatusCode::OK): self
    {
        $httpConfig = HttpConfig::set($statusCode, [
            new ContentType(MimeType::PDF),
            new ContentDisposition($fileName, ContentDisposition::INLINE),
        ]);

        return new self($fileContent, $fileName, $httpConfig);
    }

    public static function download(string $fileContent, string $fileName, int $statusCode = HttpStatusCode::OK): self
    {
        $httpConfig = HttpConfig::set($statusCode, [
            new ContentType(MimeType::PDF),
            new ContentDisposition($fileName, ContentDisposition::ATTACHMENT),
        ]);

        return new self($fileContent, $fileName, $httpConfig);
    }

    public function fileMimeType(): string
    {
        return MimeType::PDF;
    }

    protected function fileExtension(): string
    {
        return '.pdf';
    }
}
