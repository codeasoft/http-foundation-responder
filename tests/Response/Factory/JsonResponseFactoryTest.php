<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Response\Factory;

use Symfony\Component\HttpFoundation\JsonResponse;
use Tuzex\Responder\Response\Factory\JsonResponseFactory;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\Payload\JsonDocument;
use Tuzex\Responder\Response\Resource\Payload\PlainText;

final class JsonResponseFactoryTest extends ResponseFactoryTest
{
    /**
     * @param JsonDocument $resource
     * @dataProvider provideSupportedResults
     */
    public function testItReturnsValidResponse(Resource $resource): void
    {
        $response = $this->createResponse($resource);
        $responseData = json_encode($resource->list);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame($responseData, $response->getContent());
    }

    public function provideSupportedResults(): iterable
    {
        yield JsonDocument::class => [
            'resource' => JsonDocument::set(['first', 'second']),
        ];
    }

    public function provideUnsupportedResults(): iterable
    {
        yield PlainText::class => [
            'resource' => PlainText::set(''),
        ];
    }

    protected function provideSuitableResponseFactory(): JsonResponseFactory
    {
        return new JsonResponseFactory();
    }
}
