<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\ResponseFactory;

use Closure;
use Codea\SmartReply\Response\Resource;
use Codea\SmartReply\Response\Resource\Template\TwigTemplate;
use Codea\SmartReply\Response\ResponseFactory;
use Codea\SmartReply\Service\TemplateRenderer;
use Symfony\Component\HttpFoundation\Response;

final class TwigResponseFactory implements ResponseFactory
{
    public function __construct(
        private TemplateRenderer $templateRenderer
    ) {}

    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof TwigTemplate) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();
        $renderedContent = $this->templateRenderer->render($resource);

        return new Response($renderedContent, $httpConfig->statusCode(), $httpConfig->httpHeaders());
    }
}
