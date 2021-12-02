<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\HttpHeader\ContentType\UnicodeContentType;
use Tuzex\Responder\Http\MimeType\ApplicationMimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource\Data;

final class JsonDocument extends Data
{
    public static function set(iterable $list, StatusCode $statusCode = StatusCode::OK): self
    {
        $httpConfig = HttpConfig::set($statusCode, [
            new UnicodeContentType(ApplicationMimeType::JSON, UnicodeCharset::UTF8),
        ]);

        return new self($list, $httpConfig);
    }
}
