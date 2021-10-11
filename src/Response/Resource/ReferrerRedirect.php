<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource;

final class ReferrerRedirect extends Resource
{
    public static function set(int $statusCode = HttpStatusCode::FOUND): self
    {
        return new self(HttpConfig::set($statusCode));
    }
}
