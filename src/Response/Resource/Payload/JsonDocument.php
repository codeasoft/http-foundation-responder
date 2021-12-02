<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource\Data;

final class JsonDocument extends Data
{
    public static function set(iterable $list, StatusCode $statusCode = StatusCode::OK): self
    {
        $httpConfig = HttpConfig::set($statusCode, [
            new ContentType(MimeType::JSON),
        ]);

        return new self($list, $httpConfig);
    }
}
