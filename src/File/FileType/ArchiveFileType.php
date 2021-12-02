<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\FileType;

use Tuzex\Responder\File\FileType;

enum ArchiveFileType: string implements FileType
{
    case RAR = 'rar';
    case SZIP = '7z';
    case ZIP = 'zip';

    public function extension(): string
    {
        return sprintf('.%s', $this->value);
    }
}
