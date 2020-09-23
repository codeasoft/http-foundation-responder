<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Payload;

use Tuzex\Symfony\Responder\Http\Header\ContentType;
use Tuzex\Symfony\Responder\Http\MimeType;
use Tuzex\Symfony\Responder\Http\StatusCode;
use Tuzex\Symfony\Responder\Result\HttpConfigs;

final class TwigTemplate extends Template
{
    public static function init(string $name, array $parameters = [], int $statusCode = StatusCode::OK): self
    {
        return new static($name, $parameters, HttpConfigs::set($statusCode, [
            new ContentType(MimeType::HTML),
        ]));
    }

    protected function getSuffix(): string
    {
        return '.twig';
    }
}
