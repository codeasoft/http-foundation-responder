<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\File\FileFormat;
use Tuzex\Responder\File\Media\JpgFileFormat;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\ImageMimeType;
use Tuzex\Responder\Response\Resource\File;

class JpgFile extends File
{
    protected function fileFormat(): FileFormat
    {
        return new JpgFileFormat();
    }

    protected function mimeType(): MimeType
    {
        return ImageMimeType::JPG;
    }
}
