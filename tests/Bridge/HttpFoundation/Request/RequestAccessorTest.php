<?php

declare(strict_types=1);

namespace Codea\Responder\Test\Bridge\HttpFoundation\Request;

use Codea\Responder\Bridge\HttpFoundation\Request\RequestAccessor;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Symfony\Component\HttpFoundation\RequestStack;

final class RequestAccessorTest extends TestCase
{
    public function testItThrowsExceptionIfRequestMissing(): void
    {
        $requestStack = new RequestStack();
        $requestAccessor = new RequestAccessor($requestStack);

        $this->expectException(RuntimeException::class);
        $requestAccessor->get();
    }
}
