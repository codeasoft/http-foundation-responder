<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\FileData;

use Tuzex\Responder\File\FileData;
use Tuzex\Responder\File\FileInfo\JpgFileInfo;

final class JpgFileData extends FileData
{
    public function __construct(string $filename, string $content)
    {
        parent::__construct(new JpgFileInfo($filename, $filename), $content);
    }
}
