<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Bridge\HttpFoundation\Request;

use Termyn\SmartReply\Http\ReferrerProvider;

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
