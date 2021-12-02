<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http\HttpHeader\ContentDisposition;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Http\HttpHeader\ContentDisposition\InlineContentDisposition;

final class InlineContentDispositionTest extends TestCase
{
    public function testItReturnsValidField(): void
    {
        $filename = 'example.pdf';

        $httpHeader = new InlineContentDisposition($filename);
        $expectedString = sprintf('Content-Disposition: inline; filename="%s"', $filename);

        $this->assertSame($expectedString, $httpHeader->field());
    }
}
