<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\FileInfo;

use Tuzex\Responder\File\FileInfo;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\ApplicationMimeType;

final class PdfFileInfo extends FileInfo
{
    public function mime(): MimeType
    {
        return ApplicationMimeType::PDF;
    }

    protected function extension(): string
    {
        return 'pdf';
    }
}
