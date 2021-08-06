<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Definition;

use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Response\HttpConfig;

final class TwigTemplate extends Template
{
    public static function define(string $name, array $parameters = [], int $statusCode = HttpStatusCode::OK): self
    {
        $httpConfig = HttpConfig::set($statusCode, [
            new ContentType(MimeType::HTML),
        ]);

        return new self($name, $parameters, $httpConfig);
    }

    protected function type(): string
    {
        return 'twig';
    }
}
