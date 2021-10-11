<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Response\Factory;

use Closure;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Exception\UnknownResourceException;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\ResponseFactory;

abstract class ResponseFactoryTest extends TestCase
{
    /**
     * @dataProvider provideSupportedResults
     */
    abstract public function testItReturnsValidResponse(Resource $resource): void;

    /**
     * @dataProvider provideSupportedResults
     */
    public function testItSetsResponseHttpConfig(Resource $resource): void
    {
        $response = $this->createResponse($resource);

        $httpConfig = $resource->httpConfig();

        $this->assertSame($httpConfig->statusCode(), $response->getStatusCode());

        foreach ($httpConfig->headers() as $headerType => $headerValue) {
            $this->assertTrue($response->headers->contains($headerType, $headerValue));
        }
    }

    /**
     * @dataProvider provideUnsupportedResults
     */
    public function testItCallsNextResponseFactory(Resource $resource): void
    {
        $responseFactory = $this->provideSuitableResponseFactory();

        $this->expectException(UnknownResourceException::class);
        $responseFactory->create($resource, $this->provideNextResponseFactory());
    }

    abstract public function provideSupportedResults(): iterable;

    abstract public function provideUnsupportedResults(): iterable;

    protected function createResponse(Resource $resource): Response
    {
        $responseFactory = $this->provideSuitableResponseFactory();

        return $responseFactory->create($resource, $this->provideNextResponseFactory());
    }

    protected function provideNextResponseFactory(): Closure
    {
        return fn (Resource $resource) => throw new UnknownResourceException($resource);
    }

    abstract protected function provideSuitableResponseFactory(): ResponseFactory;
}
