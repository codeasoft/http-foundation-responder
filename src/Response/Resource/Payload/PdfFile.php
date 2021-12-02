<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\HttpHeader\ContentDisposition\AttachmentContentDisposition;
use Tuzex\Responder\Http\HttpHeader\ContentDisposition\InlineContentDisposition;
use Tuzex\Responder\Http\HttpHeader\ContentType\UnicodeContentType;
use Tuzex\Responder\Http\MimeType\ApplicationMimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource\File;

final class PdfFile extends File
{
    public static function setForDownload(string $path, string $name): self
    {
        $httpConfig = HttpConfig::set(StatusCode::OK, [
            new UnicodeContentType(ApplicationMimeType::PDF, UnicodeCharset::UTF8),
            new AttachmentContentDisposition($name),
        ]);

        return new self($path, $name, $httpConfig);
    }

    public static function setForDisplay(string $path, string $name): self
    {
        $httpConfig = HttpConfig::set(StatusCode::OK, [
            new UnicodeContentType(ApplicationMimeType::PDF, UnicodeCharset::UTF8),
            new InlineContentDisposition($name),
        ]);

        return new self($path, $name, $httpConfig);
    }

    protected function extension(): string
    {
        return '.pdf';
    }
}
