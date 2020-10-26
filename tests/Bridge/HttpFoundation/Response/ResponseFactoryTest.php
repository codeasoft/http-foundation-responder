<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Bridge\HttpFoundation\Response;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Bridge\HttpFoundation\Response\ResponseFactory;
use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Result\HttpConfig;

final class ResponseFactoryTest extends TestCase
{
    /**
     * @dataProvider provideResponseData
     */
    public function testItCreatesValidResponse(string $content, int $statusCode, array $headers): void
    {
        $responseFactory = new ResponseFactory();
        $response = $responseFactory->create($content, HttpConfig::set($statusCode, $headers));

        $this->assertSame($content, $response->getContent());
        $this->assertSame($statusCode, $response->getStatusCode());

        foreach ($headers as $header) {
            $this->assertSame($header->getValue(), $response->headers->get($header->getName()));
        }
    }

    public function provideResponseData(): array
    {
        return [
            200 => [
                'content' => 'Hello World!',
                'statusCode' => 200,
                'headers' => [
                    new ContentType('text/html'),
                ],
            ],
            202 => [
                'content' => 'Accept World!',
                'statusCode' => 202,
                'headers' => [
                    new ContentType('text/plain'),
                ],
            ],
        ];
    }
}
