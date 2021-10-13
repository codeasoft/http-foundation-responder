<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Middleware;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Middleware\FlashMessageEmitter;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\PlainText;
use Tuzex\Responder\Service\FlashMessagePublisher;
use Tuzex\Responder\Test\FlashMessagesGenerator;

final class FlashMessageEmitterTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testItProcessesFlashMessagesFromResults(Resource $resource, int $numberOfFlashMessages): void
    {
        $middleware = new FlashMessageEmitter(
            $this->mockFlashMessagePublisher($numberOfFlashMessages)
        );

        $middleware->execute($resource, fn (Resource $resource): Response => new Response());

        $this->assertTrue(true);
    }

    public function provideData(): iterable
    {
        foreach (FlashMessagesGenerator::generate() as $groupName => $flashMessages) {
            $resource = PlainText::set('');
            $resource->addFlashMessage(...$flashMessages);

            yield $groupName => [
                'result' => $resource,
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
