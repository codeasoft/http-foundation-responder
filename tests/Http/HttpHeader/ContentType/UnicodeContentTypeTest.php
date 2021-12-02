<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http\HttpHeader\ContentType;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\HttpHeader\ContentType\UnicodeContentType;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\TextMimeType;

final class UnicodeContentTypeTest extends TestCase
{
    /**
     * @dataProvider provideHeaderData
     */
    public function testItCreateValidHttpHeader(MimeType $mimeType, UnicodeCharset $charset): void
    {
        $contentType = new UnicodeContentType($mimeType, $charset);

        $this->assertSame(
            sprintf('Content-Type: %s; charset=%s', $mimeType->value(), $charset->value()),
            $contentType->field()
        );
    }

    public function provideHeaderData(): iterable
    {
        $data = [
            'text/plain' => 'UTF-8',
            'text/html' => 'UTF-16',
        ];

        foreach ($data as $mimeType => $charset) {
            yield $mimeType => [
                'mimeType' => TextMimeType::from($mimeType),
                'charset' => UnicodeCharset::from($charset),
            ];
        }
    }
}
