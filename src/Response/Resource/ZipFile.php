<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Tuzex\Responder\Http\Header\ContentDisposition;
use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Response\HttpConfig;

final class ZipFile extends File
{
    public static function setForDownload(string $path, string $name): self
    {
        $httpConfig = HttpConfig::set(HttpStatusCode::OK, [
            ContentType::utf8(MimeType::ZIP),
            ContentDisposition::attachment($name),
        ]);

        return new self($path, $name, $httpConfig);
    }

    public static function setForDisplay(string $path, string $name): self
    {
        $httpConfig = HttpConfig::set(HttpStatusCode::OK, [
            ContentType::utf8(MimeType::ZIP),
            ContentDisposition::inline($name),
        ]);

        return new self($path, $name, $httpConfig);
    }

    public function mimeType(): string
    {
        return MimeType::ZIP;
    }

    protected function extension(): string
    {
        return '.zip';
    }
}
