<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Stream;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Tuzex\Symfony\Responder\Bridge\Symfony\Response\BinaryFileResponseFactory;
use Tuzex\Symfony\Responder\Exception\UnsupportedResultException;
use Tuzex\Symfony\Responder\Result\Result;
use Tuzex\Symfony\Responder\Result\ResultTransformer;

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

        return $this->binaryFileResponseFactory->create($result->getPath(), $result->getHttpConfigs());
    }
}
