<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Response\Factory;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Tuzex\Responder\Response\Factory\UrlRedirectResponseFactory;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\Redirect\RouteRedirect;
use Tuzex\Responder\Response\Resource\Redirect\UrlRedirect;

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
            'resource' => UrlRedirect::set('https://www.google.com'),
        ];
    }

    public function provideUnsupportedResults(): iterable
    {
        yield RouteRedirect::class => [
            'resource' => RouteRedirect::set('index'),
        ];
    }

    protected function provideSuitableResponseFactory(): UrlRedirectResponseFactory
    {
        return new UrlRedirectResponseFactory();
    }
}
