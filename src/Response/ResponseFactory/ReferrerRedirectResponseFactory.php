<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\ResponseFactory;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Termyn\SmartReply\Http\ReferrerProvider;
use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\Resource\Redirect\ReferrerRedirect;
use Termyn\SmartReply\Response\ResponseFactory;

final class ReferrerRedirectResponseFactory implements ResponseFactory
{
    public function __construct(
        private ReferrerProvider $referrerProvider,
    ) {
    }

    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof ReferrerRedirect) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();

        return new RedirectResponse($this->referrerProvider->provide(), $httpConfig->statusCode(), $httpConfig->httpHeaders());
    }
}
