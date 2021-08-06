<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Definition;

use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\ResponseDefinition;

final class UriRedirect extends ResponseDefinition
{
    public static function define(int $statusCode = HttpStatusCode::FOUND): self
    {
        return new self(HttpConfig::set($statusCode));
    }
}
