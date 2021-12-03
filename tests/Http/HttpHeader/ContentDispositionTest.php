<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http\HttpHeader;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Http\Disposition;
use Tuzex\Responder\Http\HttpHeader\ContentDisposition;

final class ContentDispositionTest extends TestCase
{
    public const FILENAME = 'example.pdf';
    public const NAME = 'input-name';

    /**
     * @dataProvider provideTestData
     */
    public function testItContainsValidHeader(ContentDisposition $httpHeader, string $expectedValue): void
    {
        $this->assertSame('Content-Disposition', $httpHeader->name());
        $this->assertSame($expectedValue, $httpHeader->value());
    }

    public function provideTestData(): array
    {
        return [
            'attachment' => [
                'httpHeader' => new ContentDisposition(Disposition::ATTACHMENT, self::FILENAME),
                'expectedValue' => sprintf('attachment; filename="%s"', self::FILENAME),
            ],
            'inline' => [
                'httpHeader' => new ContentDisposition(Disposition::INLINE, self::FILENAME),
                'expectedValue' => sprintf('inline; filename="%s"', self::FILENAME),
            ],
            'form-data' => [
                new ContentDisposition(Disposition::FORMDATA, self::FILENAME, self::NAME),
                'expectedValue' => sprintf('form-data; name="%s" filename="%s"', self::NAME, self::FILENAME),
            ],
        ];
    }
}
