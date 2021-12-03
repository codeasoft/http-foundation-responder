<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Response\ResponseFactory;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\Redirect\RouteRedirect;
use Tuzex\Responder\Response\Resource\Redirect\UrlRedirect;
use Tuzex\Responder\Response\ResponseFactory\UrlRedirectResponseFactory;

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
