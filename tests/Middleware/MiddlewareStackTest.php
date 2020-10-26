<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Middleware;

use LogicException;
use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Middleware;
use Tuzex\Responder\Middleware\MiddlewareStack;

final class MiddlewareStackTest extends TestCase
{
    /**
     * @dataProvider provideMiddlewares
     */
    public function testItThrowsExceptionIfStackIsEmpty(array $middlewares): void
    {
        $middlewareStack = new MiddlewareStack(...$middlewares);

        for ($loop = 1; $loop <= count($middlewares); ++$loop) {
            $middlewareStack->next();
        }

        $this->expectException(LogicException::class);
        $middlewareStack->next();
    }

    public function provideMiddlewares(): array
    {
        return [
            'one' => [
                'middlewares' => [
                    $this->createMock(Middleware::class),
                ],
            ],
            'several' => [
                'middlewares' => [
                    $this->createMock(Middleware::class),
                    $this->createMock(Middleware::class),
                ],
            ],
        ];
    }
}
