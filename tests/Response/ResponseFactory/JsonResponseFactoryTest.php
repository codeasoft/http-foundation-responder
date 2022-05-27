<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Response\ResponseFactory;

use Symfony\Component\HttpFoundation\JsonResponse;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\Data\JsonData;
use Tuzex\Responder\Response\Resource\Text\PlainText;
use Tuzex\Responder\Response\ResponseFactory\JsonResponseFactory;

final class JsonResponseFactoryTest extends ResponseFactoryTest
{
    /**
     * @param JsonData $resource
     * @dataProvider provideSupportedResults
     */
    public function testItReturnsValidResponse(Resource $resource): void
    {
        $response = $this->createResponse($resource);
        $responseData = json_encode($resource->datalist());

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame($responseData, $response->getContent());
    }

    public function provideSupportedResults(): iterable
    {
        yield JsonData::class => [
            'resource' => new JsonData(['first', 'second']),
        ];
    }

    public function provideUnsupportedResults(): iterable
    {
        yield PlainText::class => [
            'resource' => new PlainText(''),
        ];
    }

    protected function provideSuitableResponseFactory(): JsonResponseFactory
    {
        return new JsonResponseFactory();
    }
}
