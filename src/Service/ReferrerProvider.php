<?php

declare(strict_types=1);

namespace Tuzex\Responder\Service;

use Tuzex\Responder\Bridge\HttpFoundation\RequestAccessor;

final class ReferrerProvider
{
    private RequestAccessor $requestProvider;

    public function __construct(RequestAccessor $requestProvider)
    {
        $this->requestProvider = $requestProvider;
    }

    public function provide(): string
    {
        $request = $this->requestProvider->get();

        $referer = $request->headers->get('referer');
        if (!$referer || !is_string($referer)) {
            return $request->getSchemeAndHttpHost();
        }

        return $referer;
    }
}
