<?php

declare(strict_types=1);

namespace Codea\Responder\Test\Http\HttpHeader;

use Codea\Responder\Http\HttpHeader\ContentDispositionHttpHeader;
use Codea\Responder\Http\HttpHeader\MultipartContentDispositionHttpHeader;
use PHPUnit\Framework\TestCase;

final class MultipartContentDispositionTest extends TestCase
{
    public const FILENAME = 'example.pdf';

    public const NAME = 'input-name';

    /**
     * @dataProvider provideTestData
     */
    public function testItContainsValidHeader(ContentDispositionHttpHeader $httpHeader, string $expectedValue): void
    {
        $this->assertSame('Content-Disposition', $httpHeader->name());
        $this->assertSame($expectedValue, $httpHeader->value());
    }

    public function provideTestData(): array
    {
        return [
            'form-data' => [
                'httpHeader' => new MultipartContentDispositionHttpHeader(self::NAME),
                'expectedValue' => sprintf('form-data; name="%s"', self::NAME),
            ],
            'form-data-with-filename' => [
                'httpHeader' => new MultipartContentDispositionHttpHeader(self::NAME, self::FILENAME),
                'expectedValue' => sprintf('form-data; name="%s"; filename="%s"', self::NAME, self::FILENAME),
            ],
        ];
    }
}
