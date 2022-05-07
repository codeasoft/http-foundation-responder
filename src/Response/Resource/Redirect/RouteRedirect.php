<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Redirect;

use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\Resource\Redirect;
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
