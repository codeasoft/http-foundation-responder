<?php

declare(strict_types=1);

namespace Codea\SmartReply\Test\Middleware;

use Codea\SmartReply\Middleware\FlashMessageEmitter;
use Codea\SmartReply\Response\Resource;
use Codea\SmartReply\Response\Resource\Redirect;
use Codea\SmartReply\Response\Resource\Redirect\ReferrerRedirect;
use Codea\SmartReply\Response\Resource\Text\PlainText;
use Codea\SmartReply\Service\FlashMessagePublisher;
use Codea\SmartReply\Test\FlashMessagesGenerator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

final class FlashMessageEmitterTest extends TestCase
{
    public function testItSkipPublishFlashMessageIfResourceIsNotRedirect(): void
    {
        $resource = new PlainText('No redirect');
        $middleware = new FlashMessageEmitter($this->mockFlashMessagePublisher(0));

        $middleware->execute($resource, fn (Resource $resource): Response => new Response());

        $this->assertTrue(true);
    }

    /**
     * @dataProvider provideData
     */
    public function testItPublishFlashMessagesIfResourceIsRedirect(Redirect $redirect, int $numberOfFlashMessages): void
    {
        $middleware = new FlashMessageEmitter(
            $this->mockFlashMessagePublisher($numberOfFlashMessages)
        );

        $middleware->execute($redirect, fn (Resource $redirect): Response => new Response());

        $this->assertTrue(true);
    }

    public function provideData(): iterable
    {
        foreach (FlashMessagesGenerator::generate() as $groupName => $flashMessages) {
            $redirect = new ReferrerRedirect();
            $redirect->addFlashMessage(...$flashMessages);

            yield $groupName => [
                'result' => $redirect,
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
}
