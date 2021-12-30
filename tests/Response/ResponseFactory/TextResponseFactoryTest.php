<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Response\ResponseFactory;

use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\Payload\HtmlText;
use Tuzex\Responder\Response\Resource\Payload\JsonData;
use Tuzex\Responder\Response\Resource\Payload\PdfFileContent;
use Tuzex\Responder\Response\Resource\Payload\PlainText;
use Tuzex\Responder\Response\ResponseFactory\TextResponseFactory;

final class TextResponseFactoryTest extends ResponseFactoryTest
{
    /**
     * @dataProvider provideSupportedResults
     */
    public function testItReturnsValidResponse(Resource $resource): void
    {
        $response = $this->createResponse($resource);

        $this->assertSame($resource->content(), $response->getContent());
    }

    public function provideSupportedResults(): iterable
    {
        $data = [
            new PlainText('Hello World!'),
            new HtmlText('<h1>Hello World!</h1>'),
            PdfFileContent::forDownload('example.pdf', 'example.pdf'),
        ];

        foreach ($data as $resource) {
            yield $resource::class => [
                'resource' => $resource,
            ];
        }
    }

    public function provideUnsupportedResults(): iterable
    {
        yield JsonData::class => [
            'resource' => new JsonData([]),
        ];
    }

    protected function provideSuitableResponseFactory(): TextResponseFactory
    {
        return new TextResponseFactory();
    }
}
