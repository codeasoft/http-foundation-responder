<?php

declare(strict_types = 1);

namespace Tuzex\Symfony\Responder\Test\Bridge\HttpFoundation\Response;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Symfony\Responder\Bridge\HttpFoundation\Response\BinaryFileResponseFactory;
use Tuzex\Symfony\Responder\Http\Header\ContentType;
use Tuzex\Symfony\Responder\Http\MimeType;
use Tuzex\Symfony\Responder\Http\StatusCode;
use Tuzex\Symfony\Responder\Result\HttpConfigs;

final class BinaryFileResponseFactoryTest extends TestCase
{
    /**
     * @dataProvider provideHttpConfigs()
     */
    public function testItCreatesResponse(string $filePath, HttpConfigs $httpConfigs): void
    {
        $responseFactory = new BinaryFileResponseFactory();
        $response = $responseFactory->create($filePath, $httpConfigs);

        $this->assertInstanceOf(Response::class, $response);
    }

    /**
     * @return HttpConfigs[]
     */
    public function provideHttpConfigs(): array
    {
        return [
            StatusCode::OK => [
                'filePath' => __DIR__ . '/example.pdf',
                'httpConfigs' => HttpConfigs::set(StatusCode::OK, [
                    new ContentType(MimeType::PDF),
                ]),
            ],
        ];
    }
}
