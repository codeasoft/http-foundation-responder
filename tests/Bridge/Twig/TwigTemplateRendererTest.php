<?php

declare(strict_types=1);

namespace Codea\Responder\Test\Bridge\Twig;

use Codea\Responder\Bridge\Twig\TwigTemplateRenderer;
use Codea\Responder\Response\Resource\Template\TwigTemplate;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface as Logger;
use Twig\Environment as Twig;
use Twig\Error\Error;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class TwigTemplateRendererTest extends TestCase
{
    private const NAME = 'example.html.twig';

    private const CONTENT = 'Hello World!';

    public function testItRendersTemplate(): void
    {
        $resource = new TwigTemplate(self::NAME);
        $templateRenderer = new TwigTemplateRenderer(
            $this->mockRenderer(),
            $this->mockLogger()
        );

        $this->assertSame(self::CONTENT, $templateRenderer->render($resource));
    }

    /**
     * @dataProvider provideErrors
     */
    public function testItThrowsExceptionOnError(Error $error): void
    {
        $resource = new TwigTemplate(self::NAME);
        $templateRenderer = new TwigTemplateRenderer(
            $this->mockRenderer($error),
            $this->mockLogger($error)
        );

        $this->expectException($error::class);
        $templateRenderer->render($resource);
    }

    public function provideErrors(): array
    {
        return [
            'loader-error' => [
                'error' => new LoaderError('Loader error'),
            ],
            'syntax-error' => [
                'error' => new SyntaxError('Syntax error'),
            ],
            'runtime-error' => [
                'error' => new RuntimeError('Runtime error'),
            ],
        ];
    }

    private function mockRenderer(?Error $error = null): Twig
    {
        $renderer = $this->createMock(Twig::class);
        $renderMethod = $renderer->expects($this->once())
            ->method('render')
            ->with(self::NAME)
            ->willReturn(self::CONTENT);

        if ($error) {
            $renderMethod->willThrowException($error);
        }

        return $renderer;
    }

    private function mockLogger(?Error $error = null): Logger
    {
        $logger = $this->createMock(Logger::class);
        if ($error) {
            $logger->expects($this->once())
                ->method('error')
                ->with(sprintf('Templating system: %s', $error->getMessage()));
        }

        return $logger;
    }
}
