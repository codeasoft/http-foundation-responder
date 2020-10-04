<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Bridge\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Tuzex\Symfony\Responder\Result\HttpConfigs;

final class BinaryFileResponseFactory
{
    public function create(string $path, HttpConfigs $httpConfigs): BinaryFileResponse
    {
        return new BinaryFileResponse($path, $httpConfigs->getStatusCode(), $httpConfigs->getHeaders());
    }
}
