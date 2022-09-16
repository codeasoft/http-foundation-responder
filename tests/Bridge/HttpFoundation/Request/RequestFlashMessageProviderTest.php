<?php

declare(strict_types=1);

namespace Codea\SmartReply\Test\Bridge\HttpFoundation\Request;

use Codea\SmartReply\Bridge\HttpFoundation\Request\RequestFlashBagProvider;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class RequestFlashMessageProviderTest extends TestCase
{
    public function testItThrowsExceptionIfFlashBagDoesNotExist(): void
    {
        $flashMessageProvider = new RequestFlashBagProvider(
            $this->createRequestStackWithSession()
        );

        $this->expectException(InvalidArgumentException::class);
        $flashMessageProvider->provide();
    }

    private function createRequestStackWithSession(): RequestStack
    {
        $request = new Request();
        $request->setSession(
            $this->mockSessionWitoutFlashBag()
        );

        $requestStack = new RequestStack();
        $requestStack->push($request);

        return $requestStack;
    }

    private function mockSessionWitoutFlashBag(): SessionInterface
    {
        $session = $this->createMock(SessionInterface::class);
        $session->expects($this->once())
            ->method('getBag')
            ->with('flashes')
            ->willReturn(
                $this->createMock(SessionBagInterface::class)
            );

        return $session;
    }
}
