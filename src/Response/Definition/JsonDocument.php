<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Definition;

use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Response\HttpConfig;

final class JsonDocument extends Data
{
    public static function define(iterable $iterable, int $statusCode = HttpStatusCode::OK): self
    {
        $httpConfig = HttpConfig::set($statusCode, [
            new ContentType(MimeType::JSON),
        ]);

        return new self($iterable, $httpConfig);
    }
}
