<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Bridge\HttpFoundation;

use PHPUnit\Framework\TestCase;
use Symfony\Contracts\Translation\TranslatorInterface;
use Tuzex\Responder\Bridge\HttpFoundation\TranslatableSessionFlashMessagePublisher;
use Tuzex\Responder\Response\FlashMessage;
use Tuzex\Responder\Service\FlashMessagePublisher;
use Tuzex\Responder\Test\FlashMessagesGenerator;

final class TranslatableSessionFlashMessagePublisherTest extends TestCase
{
    /**
     * @dataProvider provideFlashMessages
     */
    public function testItPublishFlashMessageToFlashBag(array $flashMessages, int $numberOfFlashMessages): void
    {
        $flashMessagePublisher = new TranslatableSessionFlashMessagePublisher(
            $this->mockFlashMessagePublisher($numberOfFlashMessages),
            $this->mockTranslator($numberOfFlashMessages)
        );

        foreach ($flashMessages as $flashMessage) {
            $flashMessagePublisher->publish($flashMessage);
        }

        $this->assertTrue(true);
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

    private function mockFlashMessagePublisher(int $numberOfCalls): FlashMessagePublisher
    {
        $publisher = $this->createMock(FlashMessagePublisher::class);
        $publisher->expects($this->exactly($numberOfCalls))
            ->method('publish');

        return $publisher;
    }

    private function mockTranslator(int $numberOfCalls): TranslatorInterface
    {
        $translator = $this->createMock(TranslatorInterface::class);
        $translator->expects($this->exactly($numberOfCalls))
            ->method('trans')
            ->willReturn($this->returnArgument(0));

        return $translator;
    }
}
