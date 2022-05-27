<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\FileExtension;

use Tuzex\Responder\File\FileExtension;

enum VideoFileExtension: string implements FileExtension
{
    case AVI = 'avi';
    case MP4 = 'mp4';
    case MPEG = 'mpeg';
    case OGV = 'ogg';
    case WEBM = 'webm';

    public function value(): string
    {
        return sprintf('.%s', trim($this->value, '.'));
    }
}
