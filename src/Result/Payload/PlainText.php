<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Result\HttpConfig;

final class PlainText extends Text
{
    public static function send(string $content, int $statusCode = StatusCode::OK): self
    {
        return new self($content, HttpConfig::set($statusCode, [
            new ContentType(MimeType::TEXT),
        ]));
    }
}
