<?php

declare(strict_types = 1);

namespace Tuzex\Symfony\Responder\Test\Bridge\Twig;

use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface as Logger;
use Tuzex\Symfony\Responder\Bridge\Twig\TwigTemplateRenderer;
use Twig\Environment as Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class TwigRendererTest extends TestCase
{
    public function testItRendersTemplate(): void
    {
        $output = 'Hello World!';
        $templateRenderer = new TwigTemplateRenderer(
            $this->mockTwig($output),
            $this->mockLogger()
        );

        $this->assertSame($output, $templateRenderer->render('example.html.twig', []));
    }

    /**
     * @dataProvider provideExceptions
     */
    public function testItThrownExceptionOnError(Exception $exception): void
    {
        $output = '';
        $templateRenderer = new TwigTemplateRenderer(
            $this->mockTwig($output, $exception),
            $this->mockLogger($exception)
        );

        /** @todo PHP8 => $exception::class */
        $this->expectException(get_class($exception));

        $templateRenderer->render($output, []);
    }

    public function provideExceptions(): array
    {
        return [
            LoaderError::class => [
                'exception' => new LoaderError('Templating system: Loader error'),
            ],
            SyntaxError::class => [
                'exception' => new SyntaxError('Templating system: Syntax error.'),
            ],
            RuntimeError::class => [
                'exception' => new RuntimeError('Templating system: Runtime error'),
            ],
        ];
    }

    private function mockTwig(string $output, ?Exception $exception = null): Twig
    {
        $twig = Mockery::mock(Twig::class);

        $expectation = $twig->expects('render');
        $expectation->once()
            ->with(Mockery::type('string'), Mockery::type('array'))
            ->andReturn($output);

        !$exception ?: $expectation->andThrow($exception);

        return $twig;
    }

    private function mockLogger(?Exception $exception = null): Logger
    {
        $log = Mockery::mock(Logger::class);

        if ($exception) {
            $log->expects('error')
                ->with(Mockery::type('string'))
                ->once();
        }

        return $log;
    }
}
