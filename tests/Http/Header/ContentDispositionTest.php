<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http\Header;

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

    public function provideHeaderData(): iterable
    {
        $data = [
            ContentDisposition::INLINE => 'example.pdf',
            ContentDisposition::ATTACHMENT => 'example.xls',
        ];

        foreach ($data as $disposition => $filename) {
            yield $filename => [
                'disposition' => $disposition,
                'filename' => $filename,
            ];
        }
    }
}
