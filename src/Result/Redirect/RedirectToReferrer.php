<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Redirect;

use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

final class RedirectToReferrer extends Result
{
    public static function order(int $statusCode = StatusCode::FOUND): self
    {
        return new self(HttpConfig::set($statusCode));
    }
}
