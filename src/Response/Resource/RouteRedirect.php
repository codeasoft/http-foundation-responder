<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Assert\Assertion;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource;

final class RouteRedirect extends Resource
{
    private string $route;
    private array $parameters;

    private function __construct(string $route, array $parameters, HttpConfig $httpConfig)
    {
        Assertion::notEmpty($route);

        $this->route = $route;
        $this->parameters = $parameters;

        parent::__construct($httpConfig);
    }

    public static function set(string $route, array $parameters = [], int $statusCode = HttpStatusCode::FOUND): self
    {
        return new self($route, $parameters, HttpConfig::set($statusCode));
    }

    public function route(): string
    {
        return $this->route;
    }

    public function parameters(): array
    {
        return $this->parameters;
    }
}
