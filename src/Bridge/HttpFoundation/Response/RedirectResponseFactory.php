<?php

declare(strict_types=1);

namespace Tuzex\Responder\Bridge\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Tuzex\Responder\Result\HttpConfig;

final class RedirectResponseFactory
{
    public function create(string $url, HttpConfigs $httpConfigs): RedirectResponse
    {
        return new RedirectResponse($url, $httpConfigs->getStatusCode(), $httpConfigs->getHeaders());
    }
}
