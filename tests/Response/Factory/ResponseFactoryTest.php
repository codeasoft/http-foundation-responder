<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Response\Factory;

use Closure;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Exception\UnknownResponseDefinitionException;
use Tuzex\Responder\Response\ResponseDefinition;
use Tuzex\Responder\Response\ResponseFactory;

abstract class ResponseFactoryTest extends TestCase
{
    /**
     * @dataProvider provideSupportedResults
     */
    abstract public function testItReturnsValidResponse(ResponseDefinition $responseDefinition): void;

    /**
     * @dataProvider provideSupportedResults
     */
    public function testItSetsResponseHttpConfig(ResponseDefinition $responseDefinition): void
    {
        $response = $this->createResponse($responseDefinition);

        $httpConfig = $responseDefinition->httpConfig();

        $this->assertSame($httpConfig->statusCode(), $response->getStatusCode());

        foreach ($httpConfig->headers() as $headerType => $headerValue) {
            $this->assertTrue($response->headers->contains($headerType, $headerValue));
        }
    }

    /**
     * @dataProvider provideUnsupportedResults
     */
    public function testItCallsNextResponseFactory(ResponseDefinition $responseDefinition): void
    {
        $responseFactory = $this->provideSuitableResponseFactory();

        $this->expectException(UnknownResponseDefinitionException::class);
        $responseFactory->create($responseDefinition, $this->provideNextResponseFactory());
    }

    abstract public function provideSupportedResults(): iterable;

    abstract public function provideUnsupportedResults(): iterable;

    protected function createResponse(ResponseDefinition $responseDefinition): Response
    {
        $responseFactory = $this->provideSuitableResponseFactory();

        return $responseFactory->create($responseDefinition, $this->provideNextResponseFactory());
    }

    protected function provideNextResponseFactory(): Closure
    {
        return fn (ResponseDefinition $responseDefinition) => throw new UnknownResponseDefinitionException($responseDefinition);
    }

    abstract protected function provideSuitableResponseFactory(): ResponseFactory;
}
