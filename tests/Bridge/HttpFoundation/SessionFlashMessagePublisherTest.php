<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Bridge\HttpFoundation;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Tuzex\Responder\Bridge\HttpFoundation\SessionFlashMessagePublisher;
use Tuzex\Responder\Test\FlashMessagesGenerator;

final class SessionFlashMessagePublisherTest extends TestCase
{
    /**
     * @dataProvider provideFlashMessages
     */
    public function testItPublishFlashMessageToFlashBag(array $flashMessages, int $numberOfFlashMessages): void
    {
        $flashBag = new FlashBag();
        $flashMessagePublisher = new SessionFlashMessagePublisher($flashBag);

        foreach ($flashMessages as $flashMessage) {
            $flashMessagePublisher->publish($flashMessage);
            $this->assertTrue(
                $flashBag->has($flashMessage->type())
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
}
