<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Test\Response\ResponseFactory;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\Resource\Redirect\RouteRedirect;
use Termyn\SmartReply\Response\Resource\Redirect\UrlRedirect;
use Termyn\SmartReply\Response\ResponseFactory\UrlRedirectResponseFactory;

final class UrlRedirectResponseFactoryTest extends ResponseFactoryTest
{
    /**
     * @param UrlRedirect $resource
     * @dataProvider provideSupportedResults
     */
    public function testItReturnsValidResponse(Resource $resource): void
    {
        /** @var RedirectResponse $response */
        $response = $this->createResponse($resource);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertSame($resource->url, $response->getTargetUrl());
    }

    public function provideSupportedResults(): iterable
    {
        yield UrlRedirect::class => [
            'resource' => new UrlRedirect('https://www.google.com'),
        ];
    }

    public function provideUnsupportedResults(): iterable
    {
        yield RouteRedirect::class => [
            'resource' => new RouteRedirect('index'),
        ];
    }

    protected function provideSuitableResponseFactory(): UrlRedirectResponseFactory
    {
        return new UrlRedirectResponseFactory();
    }
}
