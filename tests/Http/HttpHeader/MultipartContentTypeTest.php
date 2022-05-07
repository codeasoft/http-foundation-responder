<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http\HttpHeader;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\HttpHeader\ContentType;
use Tuzex\Responder\Http\HttpHeader\MultipartContentType;
use Tuzex\Responder\Http\MimeType\MultipartMimeType;

final class MultipartContentTypeTest extends TestCase
{
    /**
     * @dataProvider provideTestData
     */
    public function testItContainsValidHttpHeader(ContentType $httpHeader, string $expectedValue): void
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
                'httpHeader' => new MultipartContentType($multipartMimeType, $charset, $boundary),
                'expectedValue' => vsprintf('%s; boundary="%s"; charset=%s', [
                    $mimeType,
                    trim($boundary),
                    $charset->value(),
                ]),
            ];
        }
    }
}
