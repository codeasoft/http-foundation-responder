<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Middleware\CreateResponseMiddleware;
use Tuzex\Responder\Response\ResponseResource;

final class ExtendableResponder implements Responder
{
    private Closure $processor;

    public function __construct(CreateResponseMiddleware $createResponseMiddleware)
    {
        $this->processor = fn (ResponseResource $responseResource) => null;
        $this->extend($createResponseMiddleware);
    }

    public function process(ResponseResource $responseResource): Response
    {
        return ($this->processor)($responseResource);
    }

    public function extend(Middleware ...$middlewares): void
    {
        $processor = $this->processor;

        foreach ($middlewares as $middleware) {
            $this->processor = $processor = fn (ResponseResource $responseResource): Response => $middleware->execute($responseResource, $processor);
        }
    }
}
