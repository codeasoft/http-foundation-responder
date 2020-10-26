<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Http\Header\ContentDisposition;
use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\Headers;
use Tuzex\Responder\Http\MimeType;

final class HeadersTest extends TestCase
{
    /**
     * @dataProvider provideHeaders
     */
    public function testItContainsValidHeaders(array $data, array $results): void
    {
        $headers = new Headers(...$data['primary']);

        if ($data['secondary']) {
            $headers = $headers->unify(new Headers(...$data['secondary']));
        }

        foreach ($headers->all() as $type => $value) {
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
                    'primary' => [
                        new ContentType(MimeType::HTML),
                        new ContentDisposition(''),
                    ],
                    'secondary' => [],
                ],
                'results' => $results,
            ],
            'overloading' => [
                'headers' => [
                    'primary' => [
                        new ContentType(MimeType::TEXT),
                        new ContentDisposition(''),
                        new ContentType(MimeType::HTML),
                    ],
                    'secondary' => [],
                ],
                'results' => $results,
            ],
            'unification' => [
                'headers' => [
                    'primary' => [
                        new ContentType(MimeType::TEXT),
                    ],
                    'secondary' => [
                        new ContentType(MimeType::HTML),
                        new ContentDisposition(''),
                    ],
                ],
                'results' => $results,
            ],
        ];
    }
}
