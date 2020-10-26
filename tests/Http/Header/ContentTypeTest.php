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
    public function testItReturnsValidField(string $mimeType): void
    {
        $contentType = new ContentType($mimeType);

        $this->assertSame(
            sprintf('Content-Type: %s; charset=UTF-8', $mimeType),
            $contentType->getField()
        );
    }

    public function provideHeaderData(): array
    {
        return [
            'text/plain' => [
                'mimeType' => 'text/plain',
            ],
            'application/pdf' => [
                'mimeType' => 'application/pdf',
            ],
        ];
    }
}
