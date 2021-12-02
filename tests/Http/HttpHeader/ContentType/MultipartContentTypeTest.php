<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http\HttpHeader\ContentType;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Http\HttpHeader\ContentType\MultipartContentType;
use Tuzex\Responder\Http\MimeType\MultipartMimeType;

final class MultipartContentTypeTest extends TestCase
{
    /**
     * @dataProvider provideHeaderData
     */
    public function testItCreateValidHttpHeader(MultipartMimeType $mimeType, string $boundary): void
    {
        $contentType = new MultipartContentType($mimeType, $boundary);

        $this->assertSame(
            sprintf('Content-Type: %s; boundary=%s', $mimeType->value(), trim($boundary)),
            $contentType->field()
        );
    }

    public function provideHeaderData(): iterable
    {
        $data = [
            'multipart/form-data' => 'boundary-content_example',
            'multipart/mixed' => 'boundary-content_example ',
        ];

        foreach ($data as $mimeType => $boundary) {
            yield $mimeType => [
                'mimeType' => MultipartMimeType::from($mimeType),
                'boundary' => $boundary,
            ];
        }
    }
}
