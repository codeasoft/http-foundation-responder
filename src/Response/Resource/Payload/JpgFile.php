<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\File\FileInfo\JpgFileInfo;
use Tuzex\Responder\Http\Charset;
use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\Disposition;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\Resource\File;

final class JpgFile extends File
{
    public function __construct(
        JpgFileInfo $fileInfo,
        StatusCode $statusCode = StatusCode::OK,
        Disposition $disposition = Disposition::ATTACHMENT,
        Charset $charset = UnicodeCharset::UTF8,
    ) {
        parent::__construct($fileInfo, $statusCode, $disposition, $charset);
    }

    public static function forDownload(string $filepath, string $filename): self
    {
        return new self(
            fileInfo: new JpgFileInfo($filepath, $filename),
            disposition: Disposition::ATTACHMENT
        );
    }

    public static function forDisplay(string $filepath, string $filename): self
    {
        return new self(
            fileInfo: new JpgFileInfo($filepath, $filename),
            disposition: Disposition::INLINE
        );
    }
}