<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Redirect;

use Assert\Assertion;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\Resource\Redirect;

final class UrlRedirect extends Redirect
{
    public function __construct(
        public readonly string $url,
        StatusCode $statusCode = StatusCode::FOUND
    ) {
        Assertion::url($url);

        parent::__construct($statusCode);
    }
}
