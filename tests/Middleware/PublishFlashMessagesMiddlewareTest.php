<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Middleware;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Middleware\PublishFlashMessagesMiddleware;
use Tuzex\Responder\Response\Definition\PlainText;
use Tuzex\Responder\Response\FlashMessage;
use Tuzex\Responder\Response\ResponseDefinition;
use Tuzex\Responder\Service\FlashMessagePublisher;

final class PublishFlashMessagesMiddlewareTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testItProcessesFlashMessagesFromResults(ResponseDefinition $responseDefinition, int $numberOfFlashMessages): void
    {
        $middleware = new PublishFlashMessagesMiddleware(
            $this->mockFlashMessagePublisher($numberOfFlashMessages)
        );

        $middleware->execute($responseDefinition, fn (ResponseDefinition $responseDefinition): Response => new Response());

        $this->assertTrue(true);
    }

    public function provideData(): iterable
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
            $responseDefinition = PlainText::define('');
            $responseDefinition->addFlashMessage(
                ...$this->createFlashMessages($flashMessages)
            );

            yield $dataName => [
                'result' => $responseDefinition,
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

    private function createFlashMessages(array $definitions): array
    {
        $factory = fn (string $type, string $message): FlashMessage => new FlashMessage($type, $message);

        return array_map($factory, array_keys($definitions), $definitions);
    }
}
