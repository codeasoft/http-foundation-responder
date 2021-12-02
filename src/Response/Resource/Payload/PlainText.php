<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource\Text;

final class PlainText extends Text
{
    public static function set(string $payload, StatusCode $statusCode = StatusCode::OK): self
    {
        $httpConfig = HttpConfig::set($statusCode, [
            new ContentType(MimeType::TEXT),
        ]);

        return new self($payload, $httpConfig);
    }
}
