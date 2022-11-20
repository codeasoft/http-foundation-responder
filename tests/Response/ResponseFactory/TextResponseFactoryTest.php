<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Test\Response\ResponseFactory;

use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\Resource\Data\JsonData;
use Termyn\SmartReply\Response\Resource\FileContent\PdfFileContent;
use Termyn\SmartReply\Response\Resource\Text;
use Termyn\SmartReply\Response\Resource\Text\HtmlText;
use Termyn\SmartReply\Response\Resource\Text\PlainText;
use Termyn\SmartReply\Response\ResponseFactory\TextResponseFactory;

final class TextResponseFactoryTest extends ResponseFactoryTest
{
    /**
     * @param Resource&Text $resource
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
