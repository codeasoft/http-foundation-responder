<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Symfony\Component\HttpFoundation\JsonResponse;
use Tuzex\Responder\Bridge\HttpFoundation\Response\JsonResponseFactory;
use Tuzex\Responder\Exception\UnsupportedResultException;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\ResultTransformer;

final class JsonTransformer implements ResultTransformer
{
    private JsonResponseFactory $jsonResponseFactory;

    public function __construct(JsonResponseFactory $jsonResponseFactory)
    {
        $this->jsonResponseFactory = $jsonResponseFactory;
    }

    public function supports(Result $result): bool
    {
        return $result instanceof Json;
    }

    /**
     * @param Json $result
     */
    public function transform(Result $result): JsonResponse
    {
        if (!$this->supports($result)) {
            throw new UnsupportedResultException($result, self::class);
        }

        return $this->jsonResponseFactory->create($result->getData(), $result->getHttpConfig());
    }
}
