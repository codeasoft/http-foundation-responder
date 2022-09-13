<?php

declare(strict_types=1);

namespace Codea\Responder\Response\ResponseFactory;

use Closure;
use Codea\Responder\Response\Resource;
use Codea\Responder\Response\Resource\Template\TwigTemplate;
use Codea\Responder\Response\ResponseFactory;
use Codea\Responder\Service\TemplateRenderer;
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
