<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Middleware;
use Tuzex\Responder\Middleware\ProcessResultMiddleware;
use Tuzex\Responder\Middlewares;

final class MiddlewaresTest extends TestCase
{
    /**
     * @dataProvider provideMiddlewares
     */
    public function testItContainsProperlyOrganizedMiddlewares(array $objects): void
    {
        $middlewares = new Middlewares(new ProcessResultMiddleware());
        $middlewares->add(...$objects);

        $middlewareStack = $middlewares->stack();
        for ($loop = 1; $loop <= count($objects); ++$loop) {
            $middlewareStack->next();
        }

        $this->assertInstanceOf(ProcessResultMiddleware::class, $middlewareStack->next());
    }

    public function provideMiddlewares(): array
    {
        return [
            'zero' => [
                'middlewares' => [],
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
