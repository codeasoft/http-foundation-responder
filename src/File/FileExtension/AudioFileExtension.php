<?php

declare(strict_types=1);

namespace Codea\SmartReply\File\FileExtension;

use Codea\SmartReply\File\FileExtension;

enum AudioFileExtension: string implements FileExtension
{
    case AAC = 'audio/aac';
    case MIDI = 'audio/midi';
    case MP3 = 'audio/mpeg';
    case OGA = 'audio/ogg';
    case OPUS = 'audio/opus';
    case WAV = 'audio/wav';
    case WEBA = 'audio/webm';

    public function value(): string
    {
        return sprintf('.%s', trim($this->value, '.'));
    }
}
