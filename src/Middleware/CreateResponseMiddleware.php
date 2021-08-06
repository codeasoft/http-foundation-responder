<?php

declare(strict_types=1);

namespace Tuzex\Responder\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Exception\UnknownResponseDefinitionException;
use Tuzex\Responder\Middleware;
use Tuzex\Responder\Response\ResponseDefinition;
use Tuzex\Responder\Response\ResponseFactory;

final class CreateResponseMiddleware implements Middleware
{
    private Closure $producer;

    public function __construct(ResponseFactory ...$factories)
    {
        $producer = fn (ResponseDefinition $responseDefinition) => throw new UnknownResponseDefinitionException($responseDefinition);

        foreach ($factories as $factory) {
            $this->producer = $producer = fn (ResponseDefinition $responseDefinition): Response => $factory->create($responseDefinition, $producer);
        }
    }

    public function execute(ResponseDefinition $responseDefinition, Closure $nextMiddleware): Response
    {
        return ($this->producer)($responseDefinition);
    }
}
