<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Bridge\HttpFoundation;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Tuzex\Responder\Bridge\HttpFoundation\Request\RequestFlashBagProvider;
use Tuzex\Responder\Bridge\HttpFoundation\SessionFlashMessagePublisher;
use Tuzex\Responder\Test\FlashMessagesGenerator;

final class SessionFlashMessagePublisherTest extends TestCase
{
    /**
     * @dataProvider provideFlashMessages
     */
    public function testItPublishFlashMessageToFlashBag(array $flashMessages, int $numberOfFlashMessages): void
    {
        $flashBagProvider = new RequestFlashBagProvider(
            $this->createRequestStackWithSession()
        );

        $flashMessagePublisher = new SessionFlashMessagePublisher($flashBagProvider);

        $flashBag = $flashBagProvider->provide();

        foreach ($flashMessages as $flashMessage) {
            $flashMessagePublisher->publish($flashMessage);
            $this->assertTrue(
                $flashBag->has($flashMessage->type)
            );
        }

        $this->assertCount($numberOfFlashMessages, $flashBag->peekAll());
    }

    public function provideFlashMessages(): iterable
    {
        foreach (FlashMessagesGenerator::generate() as $groupName => $flashMessages) {
            yield $groupName => [
                'flashMessages' => $flashMessages,
                'numberOfFlashMessages' => count($flashMessages),
            ];
        }
    }

    private function createRequestStackWithSession(): RequestStack
    {
        $request = new Request();
        $request->setSession($this->mockSessionWithFlashBag());

        $requestStack = new RequestStack();
        $requestStack->push($request);

        return $requestStack;
    }

    private function mockSessionWithFlashBag(): SessionInterface
    {
        $session = $this->createMock(SessionInterface::class);
        $session->expects($this->atLeastOnce())
            ->method('getBag')
            ->with('flashes')
            ->willReturn(
                new FlashBag()
            );

        return $session;
    }
}
