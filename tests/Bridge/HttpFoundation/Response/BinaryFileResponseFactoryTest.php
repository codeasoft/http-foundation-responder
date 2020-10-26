<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Bridge\HttpFoundation\Response;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Bridge\HttpFoundation\Response\BinaryFileResponseFactory;
use Tuzex\Responder\Http\Header\ContentDisposition;
use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Result\HttpConfig;

final class BinaryFileResponseFactoryTest extends TestCase
{
    /**
     * @dataProvider provideResponseData
     */
    public function testItCreatesValidResponse(string $path, int $statusCode, array $headers): void
    {
        $responseFactory = new BinaryFileResponseFactory();
        $response = $responseFactory->create($path, HttpConfig::set($statusCode, $headers));

        $this->assertSame($path, $response->getFile()->getPathname());
        $this->assertSame($statusCode, $response->getStatusCode());

        foreach ($headers as $header) {
            $this->assertSame($header->getValue(), $response->headers->get($header->getName()));
        }
    }

    public function provideResponseData(): array
    {
        return [
            200 => [
                'path' => __DIR__.'/example-file',
                'statusCode' => 200,
                'headers' => [
                    new ContentType('application/pdf'),
                    new ContentDisposition('example.pdf'),
                ],
            ],
            202 => [
                'path' => __DIR__.'/example-file',
                'statusCode' => 202,
                'headers' => [
                    new ContentType('application/xls'),
                    new ContentDisposition('example.xls'),
                ],
            ],
        ];
    }
}
