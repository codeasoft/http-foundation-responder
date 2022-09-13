<?php

declare(strict_types=1);

namespace Codea\Responder\Test\Response\ResponseFactory;

use Codea\Responder\Response\Resource;
use Codea\Responder\Response\Resource\Redirect\RouteRedirect;
use Codea\Responder\Response\Resource\Redirect\UrlRedirect;
use Codea\Responder\Response\ResponseFactory\UrlRedirectResponseFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
