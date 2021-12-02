<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\HttpHeader\ContentType\UnicodeContentType;
use Tuzex\Responder\Http\MimeType\TextMimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource\Text;

final class PlainText extends Text
{
    public static function set(string $payload, StatusCode $statusCode = StatusCode::OK): self
    {
        $httpConfig = HttpConfig::set($statusCode, [
            new UnicodeContentType(TextMimeType::PLAIN, UnicodeCharset::UTF8),
        ]);

        return new self($payload, $httpConfig);
    }
}
