<?php

declare(strict_types=1);

namespace Codea\Responder\Response\Resource\Redirect;

use Codea\Responder\Http\StatusCode;
use Codea\Responder\Response\Resource\Redirect;
use Webmozart\Assert\Assert;

final class RouteRedirect extends Redirect
{
    public function __construct(
        public readonly string $route,
        public readonly array $parameters = [],
        StatusCode $statusCode = StatusCode::FOUND
    ) {
        Assert::notEmpty($this->route);

        parent::__construct($statusCode);
    }
}
