<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Bridge\HttpFoundation\Response\ResponseFactory;
use Tuzex\Responder\Exception\UnsupportedResultException;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\ResultTransformer;

final class TextTransformer implements ResultTransformer
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function supports(Result $result): bool
    {
        return $result instanceof Text;
    }

    /**
     * @param Text|Html $result
     */
    public function transform(Result $result): Response
    {
        if (!$this->supports($result)) {
            throw new UnsupportedResultException($result, self::class);
        }

        return $this->responseFactory->create($result->getContent(), $result->getHttpConfig());
    }
}
