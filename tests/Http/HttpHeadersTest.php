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
    public function testItContainsValidHeaders(array $data, array $responseDefinitions): void
    {
        $httpHeaders = new HttpHeaders(...$data['default']);
        if ($data['extended']) {
            $httpHeaders = $httpHeaders->push(new HttpHeaders(...$data['extended']));
        }

        foreach ($httpHeaders->list() as $type => $value) {
            $this->assertSame($responseDefinitions[$type]->getValue(), $value);
        }
    }

    public function provideUseCases(): array
    {
        $responseDefinitions = [
            'Content-Type' => new ContentType(MimeType::HTML),
            'Content-Disposition' => ContentDisposition::inline(''),
        ];

        return [
            'creation' => [
                'headers' => [
                    'default' => [
                        new ContentType(MimeType::HTML),
                        ContentDisposition::inline(''),
                    ],
                    'extended' => [],
                ],
                'results' => $responseDefinitions,
            ],
            'overloading' => [
                'headers' => [
                    'default' => [
                        new ContentType(MimeType::TEXT),
                        ContentDisposition::inline(''),
                        new ContentType(MimeType::HTML),
                    ],
                    'extended' => [],
                ],
                'results' => $responseDefinitions,
            ],
            'extending' => [
                'headers' => [
                    'default' => [
                        new ContentType(MimeType::HTML),
                    ],
                    'extended' => [
                        new ContentType(MimeType::TEXT),
                        ContentDisposition::inline(''),
                    ],
                ],
                'results' => $responseDefinitions,
            ],
        ];
    }
}
