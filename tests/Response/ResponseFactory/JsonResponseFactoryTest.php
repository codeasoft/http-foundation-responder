<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Test\Response\ResponseFactory;

use Symfony\Component\HttpFoundation\JsonResponse;
use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\Resource\Data\JsonData;
use Termyn\SmartReply\Response\Resource\Text\PlainText;
use Termyn\SmartReply\Response\ResponseFactory\JsonResponseFactory;

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
