<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Response\Factory;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Tuzex\Responder\Response\Definition\RouteRedirect;
use Tuzex\Responder\Response\Definition\UrlRedirect;
use Tuzex\Responder\Response\Factory\UrlRedirectResponseFactory;
use Tuzex\Responder\Response\ResponseDefinition;

final class UrlRedirectResponseFactoryTest extends ResponseFactoryTest
{
    /**
     * @param UrlRedirect $responseDefinition
     * @dataProvider provideSupportedResults
     */
    public function testItReturnsValidResponse(ResponseDefinition $responseDefinition): void
    {
        /** @var RedirectResponse $response */
        $response = $this->createResponse($responseDefinition);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertSame($responseDefinition->url(), $response->getTargetUrl());
    }

    public function provideSupportedResults(): iterable
    {
        yield UrlRedirect::class => [
            'result' => UrlRedirect::define('https://www.google.com'),
        ];
    }

    public function provideUnsupportedResults(): iterable
    {
        yield RouteRedirect::class => [
            'result' => RouteRedirect::define('index'),
        ];
    }

    protected function provideSuitableResponseFactory(): UrlRedirectResponseFactory
    {
        return new UrlRedirectResponseFactory();
    }
}
