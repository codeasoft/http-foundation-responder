<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Result\HttpConfig;

final class TwigTemplate extends Template
{
    public static function send(string $name, array $parameters = [], int $statusCode = StatusCode::OK): self
    {
        return new self($name, $parameters, HttpConfig::set($statusCode, [
            new ContentType(MimeType::HTML),
        ]));
    }

    protected function getSuffix(): string
    {
        return '.twig';
    }
}
