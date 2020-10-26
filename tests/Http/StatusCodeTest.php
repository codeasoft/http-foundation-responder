<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Http\StatusCode;

final class StatusCodeTest extends TestCase
{
    /**
     * @dataProvider provideValidStatusCodes
     */
    public function testItCreatesWithValidStatusCode(int $code): void
    {
        $this->assertSame($code, (new StatusCode($code))->getCode());
    }

    public function provideValidStatusCodes(): array
    {
        return [
            200 => [
                'code' => StatusCode::OK,
            ],
            301 => [
                'code' => StatusCode::MOVED_PERMANENTLY,
            ],
            403 => [
                'code' => StatusCode::FORBIDDEN,
            ],
            500 => [
                'code' => StatusCode::INTERNAL_SERVER_ERROR,
            ],
        ];
    }

    /**
     * @dataProvider provideInvalidStatusCodes
     */
    public function testItThrowsExceptionIfStatusCodeIsInvalid(int $code): void
    {
        $this->expectException(InvalidArgumentException::class);

        new StatusCode($code);
    }

    public function provideInvalidStatusCodes(): array
    {
        return [
            90 => [
                'code' => 90,
            ],
            600 => [
                'code' => 600,
            ],
        ];
    }
}
