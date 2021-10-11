<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Assert\Assertion;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\ResponseResource;

abstract class Template extends ResponseResource
{
    private string $path;
    private array $parameters;

    protected function __construct(string $path, array $parameters, HttpConfig $httpConfig)
    {
        Assertion::endsWith($path, sprintf('.%s', $this->type()));

        $this->path = $path;
        $this->parameters = $parameters;

        parent::__construct($httpConfig);
    }

    abstract public static function set(string $path, array $parameters = [], int $statusCode = HttpStatusCode::OK): self;

    public function path(): string
    {
        return $this->path;
    }

    public function parameters(): array
    {
        return $this->parameters;
    }

    abstract protected function type(): string;
}
