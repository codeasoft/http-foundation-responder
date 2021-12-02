<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Redirect;

use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource\Redirect;

final class UriRedirect extends Redirect
{
    public static function set(StatusCode $statusCode = StatusCode::FOUND): self
    {
        return new self(HttpConfig::set($statusCode));
    }
}
