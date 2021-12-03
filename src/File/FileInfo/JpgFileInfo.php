<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\FileInfo;

use Tuzex\Responder\File\FileInfo;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\ImageMimeType;

final class JpgFileInfo extends FileInfo
{
    public function mime(): MimeType
    {
        return ImageMimeType::JPG;
    }

    protected function extension(): string
    {
        return 'jpg';
    }
}
