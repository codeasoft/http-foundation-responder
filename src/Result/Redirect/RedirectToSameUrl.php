<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Redirect;

use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

final class RedirectToSameUrl extends Result
{
    public static function init(int $statusCode = StatusCode::OK): self
    {
        return new self(HttpConfigs::set($statusCode));
    }
}
