<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\MimeType;

use Tuzex\Responder\Http\MimeType;

enum AudioMimeType: string implements MimeType
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
        return $this->value;
    }
}
