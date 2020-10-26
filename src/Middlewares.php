<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Tuzex\Responder\Middleware\MiddlewareStack;
use Tuzex\Responder\Middleware\ProcessResultMiddleware;

final class Middlewares
{
    private array $middlewares = [];

    public function __construct(ProcessResultMiddleware $transformResultMiddleware)
    {
        $this->middlewares[] = $transformResultMiddleware;
    }

    public function add(Middleware ...$middlewares): void
    {
        $this->middlewares = array_merge($middlewares, $this->middlewares);
    }

    public function stack(): MiddlewareStack
    {
        return new MiddlewareStack(...$this->middlewares);
    }
}
