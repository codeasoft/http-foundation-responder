<?php

declare(strict_types=1);

namespace Codea\SmartReply\Bridge\Twig;

use Codea\SmartReply\Response\Resource\Template;
use Codea\SmartReply\Service\TemplateRenderer;
use Psr\Log\LoggerInterface as Logger;
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
