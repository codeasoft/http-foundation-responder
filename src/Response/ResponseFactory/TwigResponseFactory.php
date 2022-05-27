<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\ResponseFactory;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\Template\TwigTemplate;
use Tuzex\Responder\Response\ResponseFactory;
use Tuzex\Responder\Service\TemplateRenderer;

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
