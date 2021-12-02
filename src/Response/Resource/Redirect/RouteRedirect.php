<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Redirect;

use Assert\Assertion;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource\Redirect;

final class RouteRedirect extends Redirect
{
    public readonly string $route;
    public readonly array $parameters;

    private function __construct(string $route, array $parameters, HttpConfig $httpConfig)
    {
        Assertion::notEmpty($route);

        $this->route = $route;
        $this->parameters = $parameters;

        parent::__construct($httpConfig);
    }

    public static function set(string $route, array $parameters = [], StatusCode $statusCode = StatusCode::FOUND): self
    {
        return new self($route, $parameters, HttpConfig::set($statusCode));
    }
}
