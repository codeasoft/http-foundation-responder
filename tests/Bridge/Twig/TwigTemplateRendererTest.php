<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Bridge\Twig;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface as Logger;
use Tuzex\Responder\Bridge\Twig\TwigTemplateRenderer;
use Twig\Environment as Twig;
use Twig\Error\Error;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class TwigTemplateRendererTest extends TestCase
{
    private const FILENAME = 'example.html.twig';
    private const OUTPUT = 'Hello World!';

    public function testItRendersTemplate(): void
    {
        $templateRenderer = new TwigTemplateRenderer(
            $this->mockRenderer(),
            $this->mockLogger()
        );

        $this->assertSame(self::OUTPUT, $templateRenderer->render(self::FILENAME));
    }

    /**
     * @dataProvider provideErrors
     */
    public function testItThrowsExceptionOnError(Error $error): void
    {
        $templateRenderer = new TwigTemplateRenderer(
            $this->mockRenderer($error),
            $this->mockLogger($error)
        );

        $this->expectException(Error::class);
        $templateRenderer->render(self::FILENAME);
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
            ->with(self::FILENAME)
            ->willReturn(self::OUTPUT);

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
