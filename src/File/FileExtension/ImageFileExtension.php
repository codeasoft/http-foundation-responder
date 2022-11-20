<?php

declare(strict_types=1);

namespace Termyn\SmartReply\File\FileExtension;

use Termyn\SmartReply\File\FileExtension;

enum ImageFileExtension: string implements FileExtension
{
    case APNG = 'apng';
    case AVIF = 'avif';
    case GIF = 'gif';
    case JPG = 'jpeg';
    case PNG = 'png';
    case SVG = 'svg+xml';
    case WEBP = 'webp';

    public function value(): string
    {
        return sprintf('.%s', trim($this->value, '.'));
    }
}
