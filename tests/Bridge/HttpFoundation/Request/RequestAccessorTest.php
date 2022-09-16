<?php

declare(strict_types=1);

namespace Codea\SmartReply\Test\Bridge\HttpFoundation\Request;

use Codea\SmartReply\Bridge\HttpFoundation\Request\RequestAccessor;
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
