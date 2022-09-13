<?php

declare(strict_types=1);

namespace Codea\Responder\Test\Http\HttpHeader;

use Codea\Responder\Http\Charset\UnicodeCharset;
use Codea\Responder\Http\HttpHeader\ContentTypeHttpHeader;
use Codea\Responder\Http\HttpHeader\MultipartContentTypeHttpHeader;
use Codea\Responder\Http\MimeType\MultipartMimeType;
use PHPUnit\Framework\TestCase;

final class MultipartContentTypeTest extends TestCase
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
        $charset = UnicodeCharset::UTF8;
        $data = [
            'multipart/form-data' => 'boundary-content_example',
            'multipart/mixed' => 'boundary-content_example ',
        ];

        foreach ($data as $mimeType => $boundary) {
            $multipartMimeType = MultipartMimeType::from($mimeType);

            yield $mimeType => [
                'httpHeader' => new MultipartContentTypeHttpHeader($multipartMimeType, $charset, $boundary),
                'expectedValue' => vsprintf('%s; boundary="%s"; charset=%s', [
                    $mimeType,
                    trim($boundary),
                    $charset->value(),
                ]),
            ];
        }
    }
}
