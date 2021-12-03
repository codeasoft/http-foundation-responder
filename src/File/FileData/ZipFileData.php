<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\FileData;

use Tuzex\Responder\File\FileData;
use Tuzex\Responder\File\FileInfo\ZipFileInfo;

final class ZipFileData extends FileData
{
    public function __construct(string $filename, string $content)
    {
        parent::__construct(new ZipFileInfo($filename, $filename), $content);
    }
}
