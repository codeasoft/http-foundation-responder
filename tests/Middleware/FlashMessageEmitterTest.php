<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Middleware;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Middleware\FlashMessageEmitter;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\Payload\PlainText;
use Tuzex\Responder\Response\Resource\Redirect;
use Tuzex\Responder\Response\Resource\Redirect\ReferrerRedirect;
use Tuzex\Responder\Service\FlashMessagePublisher;
use Tuzex\Responder\Test\FlashMessagesGenerator;

final class FlashMessageEmitterTest extends TestCase
{
    public function testItSkipPublishFlashMessageIfResourceIsNotRedirect(): void
    {
        $resource = PlainText::set('No redirect');
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
            $redirect = ReferrerRedirect::set();
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
