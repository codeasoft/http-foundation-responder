<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Tuzex\Symfony\Responder\Exception\UnknownResultException;
use Tuzex\Symfony\Responder\Result\Result;
use Tuzex\Symfony\Responder\Result\ResultTransformer;

final class TransformResultMiddleware implements Middleware
{
    private array $transformers;

    /**
     * @param ResultTransformer[] $transformers
     */
    public function __construct(array $transformers)
    {
        $this->transformers = array_filter($transformers, fn ($transformer): bool => $transformer instanceof ResultTransformer);
    }

    public function execute(Result $result, MiddlewareStack $stack): Response
    {
        $transformer = $this->lookup($result);
        if (!$transformer) {
            throw new UnknownResultException($result);
        }

        return $transformer->transform($result);
    }

    private function lookup(Result $result): ?ResultTransformer
    {
        return array_filter($this->transformers, fn (ResultTransformer $transformer): bool => $transformer->supports($result))[0] ?? null;
    }
}
