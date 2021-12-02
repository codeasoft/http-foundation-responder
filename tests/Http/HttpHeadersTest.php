<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\HttpHeader\ContentDisposition\InlineContentDisposition;
use Tuzex\Responder\Http\HttpHeader\ContentType\UnicodeContentType;
use Tuzex\Responder\Http\HttpHeaders;
use Tuzex\Responder\Http\MimeType\TextMimeType;

final class HttpHeadersTest extends TestCase
{
    /**
     * @dataProvider provideUseCases
     */
    public function testItContainsValidHeaders(array $data, array $resources): void
    {
        $httpHeaders = new HttpHeaders(...$data['default']);
        if ($data['extended']) {
            $httpHeaders = $httpHeaders->push(new HttpHeaders(...$data['extended']));
        }

        foreach ($httpHeaders->list() as $type => $value) {
            $this->assertSame($resources[$type]->value(), $value);
        }
    }

    public function provideUseCases(): array
    {
        $resources = [
            'Content-Type' => new UnicodeContentType(TextMimeType::HTML, UnicodeCharset::UTF8),
            'Content-Disposition' => new InlineContentDisposition(''),
        ];

        return [
            'creation' => [
                'headers' => [
                    'default' => [
                        new UnicodeContentType(TextMimeType::HTML, UnicodeCharset::UTF8),
                        new InlineContentDisposition(''),
                    ],
                    'extended' => [],
                ],
                'results' => $resources,
            ],
            'overloading' => [
                'headers' => [
                    'default' => [
                        new UnicodeContentType(TextMimeType::PLAIN, UnicodeCharset::UTF8),
                        new InlineContentDisposition(''),
                        new UnicodeContentType(TextMimeType::HTML, UnicodeCharset::UTF8),
                    ],
                    'extended' => [],
                ],
                'results' => $resources,
            ],
            'extending' => [
                'headers' => [
                    'default' => [
                        new UnicodeContentType(TextMimeType::HTML, UnicodeCharset::UTF8),
                    ],
                    'extended' => [
                        new UnicodeContentType(TextMimeType::PLAIN, UnicodeCharset::UTF8),
                        new InlineContentDisposition(''),
                    ],
                ],
                'results' => $resources,
            ],
        ];
    }
}
