<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\File;

use Tuzex\Responder\File\FileExtension;
use Tuzex\Responder\File\FileExtension\ImageFileExtension;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\ImageMimeType;
use Tuzex\Responder\Response\Resource\File;

class JpgFile extends File
{
    protected function fileExtension(): FileExtension
    {
        return ImageFileExtension::JPG;
    }

    protected function mimeType(): MimeType
    {
        return ImageMimeType::JPG;
    }
}
