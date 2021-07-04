<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Redirect;

use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

final class ReferrerRedirect extends Result
{
    public static function order(int $statusCode = HttpStatusCode::FOUND): self
    {
        return new self(HttpConfig::set($statusCode));
    }
}
