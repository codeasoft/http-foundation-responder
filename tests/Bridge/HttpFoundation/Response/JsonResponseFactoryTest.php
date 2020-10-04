<?php

declare(strict_types = 1);

namespace Tuzex\Symfony\Responder\Test\Bridge\HttpFoundation\Response;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Symfony\Responder\Bridge\HttpFoundation\Response\JsonResponseFactory;
use Tuzex\Symfony\Responder\Http\Header\ContentType;
use Tuzex\Symfony\Responder\Http\MimeType;
use Tuzex\Symfony\Responder\Http\StatusCode;
use Tuzex\Symfony\Responder\Result\HttpConfigs;

final class JsonResponseFactoryTest extends TestCase
{
    /**
     * @dataProvider provideHttpConfigs()
     */
    public function testItCreatesResponse(HttpConfigs $httpConfigs): void
    {
        $responseFactory = new JsonResponseFactory();
        $response = $responseFactory->create([], $httpConfigs);

        $this->assertInstanceOf(Response::class, $response);
    }

    /**
     * @return HttpConfigs[]
     */
    public function provideHttpConfigs(): array
    {
        return [
            StatusCode::OK => [
                'httpConfigs' => HttpConfigs::set(StatusCode::OK, [
                    new ContentType(MimeType::JSON),
                ]),
            ],
        ];
    }
}
