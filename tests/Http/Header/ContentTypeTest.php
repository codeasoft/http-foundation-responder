<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http\Header;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Http\Header\ContentType;

final class ContentTypeTest extends TestCase
{
    /**
     * @dataProvider provideHeaderData
     */
    public function testItReturnsValidHttpHeader(string $mimeType, string $charset): void
    {
        $contentType = new ContentType($mimeType, $charset);

        $this->assertSame(
            sprintf('Content-Type: %s; charset=%s', $mimeType, $charset),
            $contentType->getField()
        );
    }

    public function provideHeaderData(): iterable
    {
        $data = [
            'text/plain' => 'UTF-8',
            'application/pdf' => 'UTF-16',
        ];

        foreach ($data as $mimeType => $charset) {
            yield $mimeType => [
                'mimeType' => $mimeType,
                'charset' => $charset,
            ];
        }
    }
}
