<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\ResponseFactory;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\Resource\Template\TwigTemplate;
use Termyn\SmartReply\Response\ResponseFactory;
use Termyn\SmartReply\Service\TemplateRenderer;

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
