<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Bridge\HttpFoundation;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Tuzex\Responder\Bridge\HttpFoundation\SessionFlashMessagePublisher;

final class SessionFlashMessagePublisherTest extends TestCase
{
    /**
     * @dataProvider provideFlashMessages
     */
    public function testItPublishFlashMessageToFlashBag(array $flashMessages, int $numberOfFlashMessages): void
    {
        $flashBag = new FlashBag();
        $flashMessagePublisher = new SessionFlashMessagePublisher($flashBag);

        foreach ($flashMessages as $type => $message) {
            $flashMessagePublisher->publish($type, $message);
            $this->assertTrue($flashBag->has($type));
        }

        $this->assertCount($numberOfFlashMessages, $flashBag->peekAll());
    }

    public function provideFlashMessages(): iterable
    {
        $data = [
            'anyone' => [],
            'one' => [
                'success' => 'Success!',
            ],
            'several' => [
                'error' => 'Failed!',
                'success' => 'Success!',
                'warning' => 'Warning!',
            ],
        ];

        foreach ($data as $dataName => $flashMessages) {
            yield $dataName => [
                'flashMessages' => $flashMessages,
                'numberOfFlashMessages' => count($flashMessages),
            ];
        }
    }
}
