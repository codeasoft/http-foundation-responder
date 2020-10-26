<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Bridge\HttpFoundation\Response;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Bridge\HttpFoundation\Response\RedirectResponseFactory;
use Tuzex\Responder\Result\HttpConfig;

final class RedirectResponseFactoryTest extends TestCase
{
    /**
     * @dataProvider provideResponseData
     */
    public function testItCreatesValidResponse(string $url, int $statusCode): void
    {
        $responseFactory = new RedirectResponseFactory();
        $response = $responseFactory->create($url, HttpConfig::set($statusCode));

        $this->assertSame($url, $response->getTargetUrl());
        $this->assertSame($statusCode, $response->getStatusCode());
    }

    public function provideResponseData(): array
    {
        return [
            301 => [
                'url' => 'https://google.com',
                'statusCode' => 301,
            ],
            302 => [
                'url' => 'https://maps.google.com',
                'statusCode' => 302,
            ],
        ];
    }
}
