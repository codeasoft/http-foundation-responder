<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Service;

use Tuzex\Symfony\Responder\Bridge\Symfony\RequestAccessor;

final class UriProvider
{
    private RequestAccessor $requestProvider;

    public function __construct(RequestAccessor $requestProvider)
    {
        $this->requestProvider = $requestProvider;
    }

    public function provide(): string
    {
        $request = $this->requestProvider->get();

        return $request->getUri();
    }
}
