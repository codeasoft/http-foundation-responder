<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Tuzex\Responder\Middleware\MiddlewareStack;
use Tuzex\Responder\Middleware\ProcessResultMiddleware;

final class Middlewares
{
    /** @var Middleware[] */
    private array $middlewares = [];

    public function __construct(TransformResultMiddleware $transformResultMiddleware)
    {
        $this->middlewares = [$transformResultMiddleware];
    }

    public function add(Middleware $middleware): void
    {
        array_splice($this->middlewares, $this->count() - 1, 0, [$middleware]);
    }

    public function stack(): MiddlewareStack
    {
        return new MiddlewareStack(...$this->middlewares);
    }

    private function count(): int
    {
        return count($this->middlewares);
    }
}
