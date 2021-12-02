<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Http\HttpHeader\ContentDisposition;

use PHPUnit\Framework\TestCase;
use Tuzex\Responder\Http\HttpHeader\ContentDisposition\AttachmentContentDisposition;

final class AttachmentContentDispositionTest extends TestCase
{
    public function testItReturnsValidField(): void
    {
        $filename = 'example.pdf';

        $httpHeader = new AttachmentContentDisposition($filename);
        $expectedString = sprintf('Content-Disposition: attachment; filename="%s"', $filename);

        $this->assertSame($expectedString, $httpHeader->field());
    }
}
