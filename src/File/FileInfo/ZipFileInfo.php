<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\FileInfo;

use Tuzex\Responder\File\FileInfo;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\ApplicationMimeType;

final class ZipFileInfo extends FileInfo
{
    public function mime(): MimeType
    {
        return ApplicationMimeType::ZIP;
    }

    protected function extension(): string
    {
        return 'zip';
    }
}
