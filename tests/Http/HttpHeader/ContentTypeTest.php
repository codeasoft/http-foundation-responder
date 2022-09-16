<?php

declare(strict_types=1);

namespace Codea\SmartReply\Test\Http\HttpHeader;

use Codea\SmartReply\Http\Charset\UnicodeCharset;
use Codea\SmartReply\Http\HttpHeader\ContentTypeHttpHeader;
use Codea\SmartReply\Http\MimeType\TextMimeType;
use PHPUnit\Framework\TestCase;

final class ContentTypeTest extends TestCase
{
    /**
     * @dataProvider provideTestData
     */
    public function testItContainsValidHttpHeader(ContentTypeHttpHeader $httpHeader, string $expectedValue): void
    {
        $this->assertSame('Content-Type', $httpHeader->name());
        $this->assertSame($expectedValue, $httpHeader->value());
    }

    public function provideTestData(): iterable
    {
        $data = [
            'text/plain' => 'UTF-8',
            'text/html' => 'UTF-16',
        ];

        foreach ($data as $mimeType => $charset) {
            yield $mimeType => [
                'httpHeader' => new ContentTypeHttpHeader(TextMimeType::from($mimeType), UnicodeCharset::from($charset)),
                'expectedValue' => sprintf('%s; charset=%s', $mimeType, $charset),
            ];
        }
    }
}
