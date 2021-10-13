<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test;

use Tuzex\Responder\Response\FlashMessage;

final class FlashMessagesGenerator
{
    public static function generate(): iterable
    {
        $groups = [
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

        $factory = fn (string $type, string $message): FlashMessage => new FlashMessage($type, $message);
        foreach ($groups as $name => $messages) {
            yield $name => array_map($factory, array_keys($messages), $messages);
        }
    }
}
