<?php

declare(strict_types=1);

namespace Tuzex\Responder\Service;

use Tuzex\Responder\Bridge\HttpFoundation\RequestAccessor;

final class ReferrerProvider
{
    public function __construct(
        private RequestAccessor $requestAccessor
    ) {}

    public function provide(): string
    {
        $request = $this->requestAccessor->get();

        $referer = $request->headers->get('referer');
        if (!$referer || !is_string($referer)) {
            return $request->getSchemeAndHttpHost();
        }

        return $referer;
    }
}
