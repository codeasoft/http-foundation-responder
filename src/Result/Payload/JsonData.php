<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Result\HttpConfig;

final class JsonData extends Data
{
    public static function send(iterable $data, int $statusCode = StatusCode::OK): self
    {
        return new self($data, HttpConfig::set($statusCode, [
            new ContentType(MimeType::JSON),
        ]));
    }
}
