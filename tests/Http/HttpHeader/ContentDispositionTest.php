<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http\HttpHeader;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Http\Disposition;
use Tuzex\Responder\Http\HttpHeader\ContentDispositionHttpHeader;

final class ContentDispositionTest extends TestCase
{
    public const FILENAME = 'example.pdf';

    /**
     * @dataProvider provideTestData
     */
    public function testItContainsValidHeader(ContentDispositionHttpHeader $httpHeader, string $expectedValue): void
    {
        $this->assertSame('Content-Disposition', $httpHeader->name());
        $this->assertSame($expectedValue, $httpHeader->value());
    }

    public function provideTestData(): array
    {
        return [
            'attachment' => [
                'httpHeader' => new ContentDispositionHttpHeader(Disposition::ATTACHMENT, self::FILENAME),
                'expectedValue' => sprintf('attachment; filename="%s"', self::FILENAME),
            ],
            'inline' => [
                'httpHeader' => new ContentDispositionHttpHeader(Disposition::INLINE, self::FILENAME),
                'expectedValue' => sprintf('inline; filename="%s"', self::FILENAME),
            ],
        ];
    }
}
