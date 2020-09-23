<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Bridge\Symfony\Response;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Tuzex\Symfony\Responder\Result\HttpConfigs;

final class RedirectResponseFactory
{
    public function create(string $url, HttpConfigs $httpConfigs): RedirectResponse
    {
        return new RedirectResponse($url, $httpConfigs->getStatusCode(), $httpConfigs->getHeaders());
    }
}
