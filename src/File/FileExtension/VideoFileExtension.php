<?php

declare(strict_types=1);

namespace Codea\SmartReply\File\FileExtension;

use Codea\SmartReply\File\FileExtension;

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
