<?php

declare(strict_types=1);

namespace Codea\SmartReply\Test\Response\ResponseFactory;

use Codea\SmartReply\Response\Resource;
use Codea\SmartReply\Response\Resource\Data\JsonData;
use Codea\SmartReply\Response\Resource\Text\PlainText;
use Codea\SmartReply\Response\ResponseFactory\JsonResponseFactory;
use Symfony\Component\HttpFoundation\JsonResponse;

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
