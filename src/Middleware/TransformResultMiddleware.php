<?php

declare(strict_types=1);

namespace Tuzex\Responder\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Exception\UnknownResultException;
use Tuzex\Responder\Middleware;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\ResultTransformer;

final class TransformResultMiddleware implements Middleware
{
    private array $transformers;

    public function __construct(ResultTransformer ...$transformers)
    {
        $this->transformers = $transformers;
    }

    public function execute(Result $result, MiddlewareStack $stack): Response
    {
        $transformer = $this->get($result);
        if (!$transformer) {
            throw new UnknownResultException($result);
        }

        return $transformer->transform($result);
    }

    private function get(Result $result): ?ResultTransformer
    {
        foreach ($this->transformers as $transformer) {
            if (!$transformer->supports($result)) {
                continue;
            }

            return $transformer;
        }

        return null;
    }
}
