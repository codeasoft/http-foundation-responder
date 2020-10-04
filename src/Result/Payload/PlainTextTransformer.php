<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Payload;

use Symfony\Component\HttpFoundation\Response;
use Tuzex\Symfony\Responder\Bridge\HttpFoundation\Response\ResponseFactory;
use Tuzex\Symfony\Responder\Exception\UnsupportedResultException;
use Tuzex\Symfony\Responder\Result\Result;
use Tuzex\Symfony\Responder\Result\ResultTransformer;

final class PlainTextTransformer implements ResultTransformer
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function supports(Result $result): bool
    {
        return $result instanceof PlainText;
    }

    /**
     * @param PlainText $result
     */
    public function transform(Result $result): Response
    {
        if (!$this->supports($result)) {
            throw new UnsupportedResultException($result, self::class);
        }

        return $this->responseFactory->create($result->getContent(), $result->getHttpConfigs());
    }
}
