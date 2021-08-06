<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Response\Factory;

use Symfony\Component\HttpFoundation\JsonResponse;
use Tuzex\Responder\Response\Definition\JsonDocument;
use Tuzex\Responder\Response\Definition\PlainText;
use Tuzex\Responder\Response\Factory\JsonResponseFactory;
use Tuzex\Responder\Response\ResponseDefinition;

final class JsonResponseFactoryTest extends ResponseFactoryTest
{
    /**
     * @param JsonDocument $responseDefinition
     * @dataProvider provideSupportedResults
     */
    public function testItReturnsValidResponse(ResponseDefinition $responseDefinition): void
    {
        $response = $this->createResponse($responseDefinition);
        $responseData = json_encode($responseDefinition->iterable());

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame($responseData, $response->getContent());
    }

    public function provideSupportedResults(): iterable
    {
        yield JsonDocument::class => [
            'result' => JsonDocument::define(['first', 'second']),
        ];
    }

    public function provideUnsupportedResults(): iterable
    {
        yield PlainText::class => [
            'result' => PlainText::define(''),
        ];
    }

    protected function provideSuitableResponseFactory(): JsonResponseFactory
    {
        return new JsonResponseFactory();
    }
}
