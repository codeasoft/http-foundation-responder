<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Middleware\CreateResponseMiddleware;
use Tuzex\Responder\Response\ResponseDefinition;

final class Responder
{
    private Closure $processor;

    public function __construct(CreateResponseMiddleware $createResponseMiddleware)
    {
        $this->processor = fn (ResponseDefinition $responseDefinition) => null;
        $this->extend($createResponseMiddleware);
    }

    public function process(ResponseDefinition $responseDefinition): Response
    {
        return ($this->processor)($responseDefinition);
    }

    public function extend(Middleware ...$middlewares): void
    {
        $processor = $this->processor;

        foreach ($middlewares as $middleware) {
            $this->processor = $processor = fn (ResponseDefinition $responseDefinition): Response => $middleware->execute($responseDefinition, $processor);
        }
    }
}
