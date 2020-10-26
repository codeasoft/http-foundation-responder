<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http\Header;

use Assert\AssertionFailedException;
use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Http\Header\ContentDisposition;

final class ContentDispositionTest extends TestCase
{
    /**
     * @dataProvider provideHeaderData
     */
    public function testItReturnsValidField(string $disposition, string $filename): void
    {
        $contentDisposition = ContentDisposition::$disposition($filename);

        $this->assertSame(
            sprintf('Content-Disposition: %s; filename="%s"', $disposition, $filename),
            $contentDisposition->getField()
        );
    }

    public function provideHeaderData(): array
    {
        return [
            'example.pdf' => [
                'disposition' => ContentDisposition::INLINE,
                'filename' => 'example.pdf',
            ],
            'example.xls' => [
                'disposition' => ContentDisposition::ATTACHMENT,
                'filename' => 'example.xls',
            ],
        ];
    }

    public function testItThrowsExceptionIfDispositionIsInvalid(): void
    {
        $this->expectException(AssertionFailedException::class);

        new ContentDisposition('example.pdf', 'online');
    }
}
