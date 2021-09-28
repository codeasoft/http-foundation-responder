<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Response\Factory;

use Closure;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Exception\UnknownResponseResourceException;
use Tuzex\Responder\Response\ResponseFactory;
use Tuzex\Responder\Response\ResponseResource;

abstract class ResponseFactoryTest extends TestCase
{
    /**
     * @dataProvider provideSupportedResults
     */
    abstract public function testItReturnsValidResponse(ResponseResource $responseResource): void;

    /**
     * @dataProvider provideSupportedResults
     */
    public function testItSetsResponseHttpConfig(ResponseResource $responseResource): void
    {
        $response = $this->createResponse($responseResource);

        $httpConfig = $responseResource->httpConfig();

        $this->assertSame($httpConfig->statusCode(), $response->getStatusCode());

        foreach ($httpConfig->headers() as $headerType => $headerValue) {
            $this->assertTrue($response->headers->contains($headerType, $headerValue));
        }
    }

    /**
     * @dataProvider provideUnsupportedResults
     */
    public function testItCallsNextResponseFactory(ResponseResource $responseResource): void
    {
        $responseFactory = $this->provideSuitableResponseFactory();

        $this->expectException(UnknownResponseResourceException::class);
        $responseFactory->create($responseResource, $this->provideNextResponseFactory());
    }

    abstract public function provideSupportedResults(): iterable;

    abstract public function provideUnsupportedResults(): iterable;

    protected function createResponse(ResponseResource $responseResource): Response
    {
        $responseFactory = $this->provideSuitableResponseFactory();

        return $responseFactory->create($responseResource, $this->provideNextResponseFactory());
    }

    protected function provideNextResponseFactory(): Closure
    {
        return fn (ResponseResource $responseResource) => throw new UnknownResponseResourceException($responseResource);
    }

    abstract protected function provideSuitableResponseFactory(): ResponseFactory;
}
