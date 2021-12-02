<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\Http\Header\ContentDisposition;
use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource\FileContent;

final class JpgFileContent extends FileContent
{
    public static function setForDownload(string $content, string $name): self
    {
        $httpConfig = HttpConfig::set(HttpStatusCode::OK, [
            ContentType::utf8(MimeType::JPG),
            ContentDisposition::attachment($name),
        ]);

        return new self($content, $name, $httpConfig);
    }

    public static function setForDisplay(string $content, string $name): self
    {
        $httpConfig = HttpConfig::set(HttpStatusCode::OK, [
            ContentType::utf8(MimeType::JPG),
            ContentDisposition::inline($name),
        ]);

        return new self($content, $name, $httpConfig);
    }

    public function mimeType(): string
    {
        return MimeType::JPG;
    }

    protected function extension(): string
    {
        return '.jpg';
    }
}
