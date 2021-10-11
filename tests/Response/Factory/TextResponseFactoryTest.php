<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Response\Factory;

use Tuzex\Responder\Response\Factory\TextResponseFactory;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\HtmlDocument;
use Tuzex\Responder\Response\Resource\JsonDocument;
use Tuzex\Responder\Response\Resource\PdfFileContent;
use Tuzex\Responder\Response\Resource\PlainText;
use Tuzex\Responder\Response\Resource\Text;

final class TextResponseFactoryTest extends ResponseFactoryTest
{
    /**
     * @param Text $resource
     * @dataProvider provideSupportedResults
     */
    public function testItReturnsValidResponse(Resource $resource): void
    {
        $response = $this->createResponse($resource);

        $this->assertSame($resource->payload(), $response->getContent());
    }

    public function provideSupportedResults(): iterable
    {
        $data = [
            PlainText::set('Hello World!'),
            HtmlDocument::set('<h1>Hello World!</h1>'),
            PdfFileContent::setForDownload('example.pdf', 'example.pdf'),
        ];

        foreach ($data as $resource) {
            yield $resource::class => [
                'result' => $resource,
            ];
        }
    }

    public function provideUnsupportedResults(): iterable
    {
        yield JsonDocument::class => [
            'result' => JsonDocument::set([]),
        ];
    }

    protected function provideSuitableResponseFactory(): TextResponseFactory
    {
        return new TextResponseFactory();
    }
}
