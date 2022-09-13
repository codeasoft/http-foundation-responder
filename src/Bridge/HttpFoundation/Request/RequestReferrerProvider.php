<?php

declare(strict_types=1);

namespace Codea\Responder\Bridge\HttpFoundation\Request;

use Codea\Responder\Http\ReferrerProvider;

final class RequestReferrerProvider implements ReferrerProvider
{
    public function __construct(
        private RequestAccessor $requestAccessor
    ) {}

    public function provide(): string
    {
        $request = $this->requestAccessor->get();

        return $request->headers->get('referer') ?? $request->getSchemeAndHttpHost();
    }
}
