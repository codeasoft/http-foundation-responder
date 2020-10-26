<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Tuzex\Responder\Bridge\HttpFoundation\Response\BinaryFileResponseFactory;
use Tuzex\Responder\Exception\UnsupportedResultException;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\ResultTransformer;

final class FileTransformer implements ResultTransformer
{
    private BinaryFileResponseFactory $binaryFileResponseFactory;

    public function __construct(BinaryFileResponseFactory $binaryFileResponseFactory)
    {
        $this->binaryFileResponseFactory = $binaryFileResponseFactory;
    }

    public function supports(Result $result): bool
    {
        return $result instanceof File;
    }

    /**
     * @param File $result
     */
    public function transform(Result $result): BinaryFileResponse
    {
        if (!$this->supports($result)) {
            throw new UnsupportedResultException($result, self::class);
        }

        return $this->binaryFileResponseFactory->create($result->getPath(), $result->getHttpConfig());
    }
}
