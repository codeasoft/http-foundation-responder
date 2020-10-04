<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Test\Bridge\HttpFoundation;

use Mockery;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Tuzex\Symfony\Responder\Bridge\HttpFoundation\RequestAccessor;

final class RequestAccessorTest extends TestCase
{
    public function testItReturnsRequest(): void
    {
        $requestAccessor = $this->initRequestAccessor(true);
        $request = $requestAccessor->get();

        $this->assertInstanceOf(Request::class, $request);
    }

    public function testItThrowsExceptionIfRequestMissing(): void
    {
        $this->expectException(RuntimeException::class);

        $this->initRequestAccessor(false)->get();
    }

    private function initRequestAccessor(bool $withRequest): RequestAccessor
    {
        return new RequestAccessor($this->mockRequestStack($withRequest));
    }

    private function mockRequestStack(bool $withRequest): RequestStack
    {
        $requestStack = Mockery::mock(RequestStack::class);
        $requestStack->allows([
            'getCurrentRequest' => $withRequest ? Mockery::mock(Request::class) : null,
        ]);

        return $requestStack;
    }
}
