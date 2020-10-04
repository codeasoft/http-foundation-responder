<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Payload;

use Symfony\Component\HttpFoundation\JsonResponse;
use Tuzex\Symfony\Responder\Bridge\HttpFoundation\Response\JsonResponseFactory;
use Tuzex\Symfony\Responder\Exception\UnsupportedResultException;
use Tuzex\Symfony\Responder\Result\Result;
use Tuzex\Symfony\Responder\Result\ResultTransformer;

final class JsonDataTransformer implements ResultTransformer
{
    private JsonResponseFactory $jsonResponseFactory;

    public function __construct(JsonResponseFactory $jsonResponseFactory)
    {
        $this->jsonResponseFactory = $jsonResponseFactory;
    }

    public function supports(Result $result): bool
    {
        return $result instanceof JsonData;
    }

    /**
     * @param JsonData $result
     */
    public function transform(Result $result): JsonResponse
    {
        if (!$this->supports($result)) {
            throw new UnsupportedResultException($result, self::class);
        }

        return $this->jsonResponseFactory->create($result->getData(), $result->getHttpConfigs());
    }
}
