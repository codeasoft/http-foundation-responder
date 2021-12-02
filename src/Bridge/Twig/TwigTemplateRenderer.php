<?php

declare(strict_types=1);

namespace Tuzex\Responder\Bridge\Twig;

use Psr\Log\LoggerInterface as Logger;
use Tuzex\Responder\Response\Resource\Template;
use Tuzex\Responder\Service\TemplateRenderer;
use Twig\Environment as Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class TwigTemplateRenderer implements TemplateRenderer
{
    public function __construct(
        private Twig $twig,
        private Logger $logger,
    ) {}

    public function render(Template $template): string
    {
        try {
            return $this->twig->render($template->name, $template->parameters);
        } catch (LoaderError | SyntaxError | RuntimeError $exception) {
            $this->logger->error(sprintf('Templating system: %s', $exception->getMessage()));

            throw $exception;
        }
    }
}
