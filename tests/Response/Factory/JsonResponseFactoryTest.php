<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Response\Factory;

use Symfony\Component\HttpFoundation\JsonResponse;
use Tuzex\Responder\Response\Factory\JsonResponseFactory;
use Tuzex\Responder\Response\Resource\JsonDocument;
use Tuzex\Responder\Response\Resource\PlainText;
use Tuzex\Responder\Response\ResponseResource;

final class JsonResponseFactoryTest extends ResponseFactoryTest
{
    /**
     * @param JsonDocument $responseResource
     * @dataProvider provideSupportedResults
     */
    public function testItReturnsValidResponse(ResponseResource $responseResource): void
    {
        $response = $this->createResponse($responseResource);
        $responseData = json_encode($responseResource->iterable());

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
