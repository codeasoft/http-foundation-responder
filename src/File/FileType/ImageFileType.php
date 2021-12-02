<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\FileType;

use Tuzex\Responder\File\FileType;

enum ImageFileType: string implements FileType
{
    case APNG = 'apng';
    case AVIF = 'avif';
    case GIF = 'gif';
    case JPG = 'jpg';
    case PNG = 'png';
    case SVG = 'svg';
    case WEBP = 'webp';

    public function extension(): string
    {
        return sprintf('.%s', $this->value);
    }
}
