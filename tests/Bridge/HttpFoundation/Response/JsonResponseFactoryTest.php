<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Bridge\HttpFoundation\Response;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Bridge\HttpFoundation\Response\JsonResponseFactory;
use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Result\HttpConfig;

final class JsonResponseFactoryTest extends TestCase
{
    /**
     * @dataProvider provideResponseData
     */
    public function testItCreatesValidResponse(array $data, int $statusCode, array $headers): void
    {
        $responseFactory = new JsonResponseFactory();
        $response = $responseFactory->create($data, HttpConfig::set($statusCode, $headers));

        $this->assertSame(json_encode($data), $response->getContent());
        $this->assertSame($statusCode, $response->getStatusCode());

        foreach ($headers as $header) {
            $this->assertSame($header->getValue(), $response->headers->get($header->getName()));
        }
    }

    public function provideResponseData(): array
    {
        $contentType = new ContentType('application/json');

        return [
            200 => [
                'data' => [
                    'Hello World!',
                    'John Doe',
                ],
                'statusCode' => 200,
                'headers' => [
                    $contentType,
                ],
            ],
            204 => [
                'data' => [''],
                'statusCode' => 204,
                'headers' => [
                    $contentType,
                ],
            ],
        ];
    }
}
