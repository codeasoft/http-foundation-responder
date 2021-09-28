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
     * @dataProvider provideUseCases
     */
    public function testItContainsValidHeaders(array $data, array $responseResources): void
    {
        $httpHeaders = new HttpHeaders(...$data['default']);
        if ($data['extended']) {
            $httpHeaders = $httpHeaders->push(new HttpHeaders(...$data['extended']));
        }

        foreach ($httpHeaders->list() as $type => $value) {
            $this->assertSame($responseResources[$type]->value(), $value);
        }
    }

    public function provideUseCases(): array
    {
        $responseResources = [
            'Content-Type' => ContentType::utf8(MimeType::HTML),
            'Content-Disposition' => ContentDisposition::inline(''),
        ];

        return [
            'creation' => [
                'headers' => [
                    'default' => [
                        ContentType::utf8(MimeType::HTML),
                        ContentDisposition::inline(''),
                    ],
                    'extended' => [],
                ],
                'results' => $responseResources,
            ],
            'overloading' => [
                'headers' => [
                    'default' => [
                        ContentType::utf8(MimeType::TEXT),
                        ContentDisposition::inline(''),
                        ContentType::utf8(MimeType::HTML),
                    ],
                    'extended' => [],
                ],
                'results' => $responseResources,
            ],
            'extending' => [
                'headers' => [
                    'default' => [
                        ContentType::utf8(MimeType::HTML),
                    ],
                    'extended' => [
                        ContentType::utf8(MimeType::TEXT),
                        ContentDisposition::inline(''),
                    ],
                ],
                'results' => $responseResources,
            ],
        ];
    }
}
