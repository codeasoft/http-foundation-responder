<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\FileData;

use Tuzex\Responder\File\FileData;
use Tuzex\Responder\File\FileInfo\PdfFileInfo;

final class PdfFileData extends FileData
{
    public function __construct(string $filename, string $content)
    {
        parent::__construct(new PdfFileInfo($filename, $filename), $content);
    }
}
