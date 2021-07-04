<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Middleware\CreateResponseMiddleware;

final class PipeResponder implements Responder
{
    private Closure $processor;

    public function __construct(CreateResponseMiddleware $middleware)
    {
        $this->processor = static fn (Result $result) => null;
        $this->extend($middleware);
    }

    public function process(Result $result): Response
    {
        return ($this->processor)($result);
    }

    public function extend(Middleware ...$middlewares): void
    {
        $next = $this->processor;

        foreach ($middlewares as $middleware) {
            $this->processor = $next = static fn (Result $result): Response => $middleware->execute($result, $next);
        }
    }
}
