<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\File\FileData\ZipFileData;
use Tuzex\Responder\Http\Charset;
use Tuzex\Responder\Http\Charset\UnicodeCharset;
use Tuzex\Responder\Http\Disposition;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\Resource\FileContent;

final class ZipFileContent extends FileContent
{
    public function __construct(
        ZipFileData $fileData,
        StatusCode $statusCode = StatusCode::OK,
        Disposition $disposition = Disposition::ATTACHMENT,
        Charset $charset = UnicodeCharset::UTF8,
    ) {
        parent::__construct($fileData, $statusCode, $disposition, $charset);
    }

    public static function forDownload(string $filename, string $content): self
    {
        return new self(
            fileData: new ZipFileData($filename, $content),
            disposition: Disposition::ATTACHMENT
        );
    }

    public static function forDisplay(string $filename, string $content): self
    {
        return new self(
            fileData: new ZipFileData($filename, $content),
            disposition: Disposition::INLINE
        );
    }
}
