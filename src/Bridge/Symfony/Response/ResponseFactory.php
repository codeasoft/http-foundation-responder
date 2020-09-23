<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Bridge\Symfony\Response;

use Symfony\Component\HttpFoundation\Response;
use Tuzex\Symfony\Responder\Result\HttpConfigs;

final class ResponseFactory
{
    public function create(string $content, HttpConfigs $httpConfigs): Response
    {
        return new Response($content, $httpConfigs->getStatusCode(), $httpConfigs->getHeaders());
    }
}
