<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\File\FileType;
use Tuzex\Responder\File\FileType\TemplateFileType;
use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\HttpHeader\ContentType\UnicodeContentType;
use Tuzex\Responder\Http\MimeType\TextMimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource\Template;

final class TwigTemplate extends Template
{
    public static function set(string $filename, array $parameters = [], StatusCode $statusCode = StatusCode::OK): self
    {
        $httpConfig = HttpConfig::set($statusCode, [
            new UnicodeContentType(TextMimeType::HTML, UnicodeCharset::UTF8),
        ]);

        return new self($filename, $parameters, $httpConfig);
    }

    protected function fileType(): FileType
    {
        return TemplateFileType::TWIG;
    }
}
