<?php

declare(strict_types=1);

namespace Tuzex\Responder\Bridge\Twig;

use Psr\Log\LoggerInterface as Logger;
use Tuzex\Responder\Service\TemplateRenderer;
use Twig\Environment as Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class TwigTemplateRenderer implements TemplateRenderer
{
    private Twig $twig;
    private Logger $logger;

    public function __construct(Twig $twig, Logger $logger)
    {
        $this->twig = $twig;
        $this->logger = $logger;
    }

    public function render(string $name, array $parameters = []): string
    {
        try {
            return $this->twig->render($name, $parameters);
        } catch (LoaderError | SyntaxError | RuntimeError $exception) {
            $this->logger->error(
                sprintf('Templating system: %s', $exception->getMessage())
            );

            throw $exception;
        }
    }
}
