<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Http\Header\ContentDisposition;
use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\HttpHeaders;
use Tuzex\Responder\Http\MimeType;

final class HttpHeadersTest extends TestCase
{
    /**
     * @dataProvider provideHeaders
     */
    public function testItContainsValidHeaders(array $data, array $results): void
    {
        $httpHeaders = new HttpHeaders(...$data['default']);
        if ($data['extended']) {
            $httpHeaders = $httpHeaders->push(new HttpHeaders(...$data['extended']));
        }

        foreach ($httpHeaders->list() as $type => $value) {
            $this->assertSame($results[$type]->getValue(), $value);
        }
    }

    public function provideHeaders(): array
    {
        $results = [
            'Content-Type' => new ContentType(MimeType::HTML),
            'Content-Disposition' => new ContentDisposition(''),
        ];

        return [
            'creation' => [
                'headers' => [
                    'default' => [
                        new ContentType(MimeType::HTML),
                        new ContentDisposition(''),
                    ],
                    'extended' => [],
                ],
                'results' => $results,
            ],
            'overloading' => [
                'headers' => [
                    'default' => [
                        new ContentType(MimeType::TEXT),
                        new ContentDisposition(''),
                        new ContentType(MimeType::HTML),
                    ],
                    'extended' => [],
                ],
                'results' => $results,
            ],
            'extending' => [
                'headers' => [
                    'default' => [
                        new ContentType(MimeType::HTML),
                    ],
                    'extended' => [
                        new ContentType(MimeType::TEXT),
                        new ContentDisposition(''),
                    ],
                ],
                'results' => $results,
            ],
        ];
    }
}
