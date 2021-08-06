<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Definition;

use Assert\Assertion;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\ResponseDefinition;

final class RouteRedirect extends ResponseDefinition
{
    private string $name;
    private array $parameters;

    private function __construct(string $template, array $parameters, HttpConfig $httpConfig)
    {
        Assertion::notEmpty($template);

        $this->name = $template;
        $this->parameters = $parameters;

        parent::__construct($httpConfig);
    }

    public static function define(string $name, array $parameters = [], int $statusCode = HttpStatusCode::FOUND): self
    {
        return new self($name, $parameters, HttpConfig::set($statusCode));
    }

    public function name(): string
    {
        return $this->name;
    }

    public function parameters(): array
    {
        return $this->parameters;
    }
}
