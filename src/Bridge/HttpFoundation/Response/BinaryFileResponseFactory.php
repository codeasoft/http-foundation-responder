<?php

declare(strict_types=1);

namespace Tuzex\Responder\Bridge\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Tuzex\Responder\Result\HttpConfig;

final class BinaryFileResponseFactory
{
    public function create(string $path, HttpConfigs $httpConfigs): BinaryFileResponse
    {
        return new BinaryFileResponse($path, $httpConfigs->getStatusCode(), $httpConfigs->getHeaders());
    }
}