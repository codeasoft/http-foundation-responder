<?php

declare(strict_types = 1);

namespace Tuzex\Symfony\Responder\Test\Bridge\HttpFoundation\Response;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Symfony\Responder\Bridge\HttpFoundation\Response\RedirectResponseFactory;
use Tuzex\Symfony\Responder\Http\StatusCode;
use Tuzex\Symfony\Responder\Result\HttpConfigs;

final class RedirectResponseFactoryTest extends TestCase
{
    /**
     * @dataProvider provideHttpConfigs()
     */
    public function testItCreatesResponse(HttpConfigs $httpConfigs): void
    {
        $responseFactory = new RedirectResponseFactory();
        $response = $responseFactory->create('https://google.com', $httpConfigs);

        $this->assertInstanceOf(Response::class, $response);
    }

    /**
     * @return HttpConfigs[]
     */
    public function provideHttpConfigs(): array
    {
        return [
            StatusCode::FOUND => [
                'httpConfigs' => HttpConfigs::set(StatusCode::FOUND),
            ],
        ];
    }
}
