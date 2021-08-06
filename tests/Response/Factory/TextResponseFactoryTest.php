<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Response\Factory;

use Tuzex\Responder\Response\Definition\HtmlDocument;
use Tuzex\Responder\Response\Definition\JsonDocument;
use Tuzex\Responder\Response\Definition\PdfFileContent;
use Tuzex\Responder\Response\Definition\PlainText;
use Tuzex\Responder\Response\Definition\Text;
use Tuzex\Responder\Response\Factory\TextResponseFactory;
use Tuzex\Responder\Response\ResponseDefinition;

final class TextResponseFactoryTest extends ResponseFactoryTest
{
    /**
     * @param Text $responseDefinition
     * @dataProvider provideSupportedResults
     */
    public function testItReturnsValidResponse(ResponseDefinition $responseDefinition): void
    {
        $response = $this->createResponse($responseDefinition);

        $this->assertSame($responseDefinition->body(), $response->getContent());
    }

    public function provideSupportedResults(): iterable
    {
        $data = [
            PlainText::define('Hello World!'),
            HtmlDocument::define('<h1>Hello World!</h1>'),
            PdfFileContent::defineForDownload('example.pdf', 'example.pdf'),
        ];

        foreach ($data as $responseDefinition) {
            yield $responseDefinition::class => [
                'result' => $responseDefinition,
            ];
        }
    }

    public function provideUnsupportedResults(): iterable
    {
        yield JsonDocument::class => [
            'result' => JsonDocument::define([]),
        ];
    }

    protected function provideSuitableResponseFactory(): TextResponseFactory
    {
        return new TextResponseFactory();
    }
}
