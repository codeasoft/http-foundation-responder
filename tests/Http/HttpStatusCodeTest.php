<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Http\HttpStatusCode;

final class HttpStatusCodeTest extends TestCase
{
    /**
     * @dataProvider provideValidStatusCodes
     */
    public function testItCreatesWithValidHttpStatusCode(int $code): void
    {
        $this->assertSame($code, (new HttpStatusCode($code))->code());
    }

    public function provideValidStatusCodes(): array
    {
        return array_map(fn (int $code): array => [
            $code => $code,
        ], [
            HttpStatusCode::OK,
            HttpStatusCode::MOVED_PERMANENTLY,
            HttpStatusCode::FORBIDDEN,
            HttpStatusCode::INTERNAL_SERVER_ERROR,
        ]);
    }

    /**
     * @dataProvider provideInvalidStatusCodes
     */
    public function testItThrowsExceptionIfHttpStatusCodeIsOutOfRange(int $code): void
    {
        $this->expectException(InvalidArgumentException::class);

        new HttpStatusCode($code);
    }

    public function provideInvalidStatusCodes(): array
    {
        return array_map(fn (int $code): array => [
            $code => $code,
        ], [90, 600]);
    }
}
