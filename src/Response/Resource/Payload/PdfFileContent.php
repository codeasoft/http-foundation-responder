<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\File\FileType;
use Tuzex\Responder\File\FileType\DocumentFileType;
use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\HttpHeader\ContentDisposition\AttachmentContentDisposition;
use Tuzex\Responder\Http\HttpHeader\ContentDisposition\InlineContentDisposition;
use Tuzex\Responder\Http\HttpHeader\ContentType\UnicodeContentType;
use Tuzex\Responder\Http\MimeType\ApplicationMimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource\FileContent;

final class PdfFileContent extends FileContent
{
    public static function setForDownload(string $content, string $name): self
    {
        $httpConfig = HttpConfig::set(StatusCode::OK, [
            new UnicodeContentType(ApplicationMimeType::PDF, UnicodeCharset::UTF8),
            new AttachmentContentDisposition($name),
        ]);

        return new self($content, $name, $httpConfig);
    }

    public static function setForDisplay(string $content, string $name): self
    {
        $httpConfig = HttpConfig::set(StatusCode::OK, [
            new UnicodeContentType(ApplicationMimeType::PDF, UnicodeCharset::UTF8),
            new InlineContentDisposition($name),
        ]);

        return new self($content, $name, $httpConfig);
    }

    protected function fileType(): FileType
    {
        return DocumentFileType::PDF;
    }
}
