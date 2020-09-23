<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Redirect;

use Tuzex\Symfony\Responder\Http\StatusCode;
use Tuzex\Symfony\Responder\Result\HttpConfigs;
use Tuzex\Symfony\Responder\Result\Result;

final class RedirectToReferer extends Result
{
    public static function init(int $statusCode = StatusCode::FOUND): self
    {
        return new self(HttpConfigs::set($statusCode));
    }
}
