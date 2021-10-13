<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Assert\Assertion;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource;

abstract class Template extends Resource
{
    private string $name;
    private array $parameters;

    protected function __construct(string $name, array $parameters, HttpConfig $httpConfig)
    {
        Assertion::endsWith($name, sprintf('.%s', $this->type()));

        $this->name = $name;
        $this->parameters = $parameters;

        parent::__construct($httpConfig);
    }

    abstract public static function set(string $name, array $parameters = [], int $statusCode = HttpStatusCode::OK): self;

    public function name(): string
    {
        return $this->name;
    }

    public function parameters(): array
    {
        return $this->parameters;
    }

    abstract protected function type(): string;
}
