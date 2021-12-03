<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http\HttpHeader;

use PHPUnit\Framework\TestCase;
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
        $data = [
            'multipart/form-data' => 'boundary-content_example',
            'multipart/mixed' => 'boundary-content_example ',
        ];

        foreach ($data as $mimeType => $boundary) {
            yield $mimeType => [
                'httpHeader' => new MultipartContentType(MultipartMimeType::from($mimeType), $boundary),
                'expectedValue' => sprintf('%s; boundary="%s"', $mimeType, trim($boundary)),
            ];
        }
    }
}
