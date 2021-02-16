<?php

declare(strict_types=1);

namespace Tuzex\Responder\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Exception\UnknownResultException;
use Tuzex\Responder\Middleware;
use Tuzex\Responder\ResponseFactory;
use Tuzex\Responder\Result;

final class CreateResponseMiddleware implements Middleware
{
    private Closure $factory;

    public function __construct(ResponseFactory ...$factories)
    {
        $next = static fn (Result $result) => throw new UnknownResultException($result);

        foreach ($factories as $factory) {
            $this->factory = $next = static fn (Result $result): Response => $factory->create($result, $next);
        }
    }

    public function execute(Result $result, Closure $next): Response
    {
        $next($result);

        return ($this->factory)($result);
    }
}
