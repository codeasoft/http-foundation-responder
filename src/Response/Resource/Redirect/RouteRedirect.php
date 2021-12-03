<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Redirect;

use Assert\Assertion;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\Resource\Redirect;

final class RouteRedirect extends Redirect
{
    public function __construct(
        public readonly string $route,
        public readonly array $parameters = [],
        StatusCode $statusCode = StatusCode::FOUND
    ) {
        Assertion::notEmpty($this->route);

        parent::__construct($statusCode);
    }
}
