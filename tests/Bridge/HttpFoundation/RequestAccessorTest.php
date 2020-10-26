<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Bridge\HttpFoundation;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Symfony\Component\HttpFoundation\RequestStack;
use Tuzex\Responder\Bridge\HttpFoundation\RequestAccessor;

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
