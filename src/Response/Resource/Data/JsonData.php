<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource\Data;

use Termyn\SmartReply\Http\Charset;
use Termyn\SmartReply\Http\Charset\UnicodeCharset;
use Termyn\SmartReply\Http\HttpHeader\ContentTypeHttpHeader;
use Termyn\SmartReply\Http\MimeType\ApplicationMimeType;
use Termyn\SmartReply\Http\StatusCode;
use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\Resource\Data;

final class JsonData extends Resource implements Data
{
    public function __construct(
        public readonly iterable $datalist,
        StatusCode $statusCode = StatusCode::OK,
        Charset $charset = UnicodeCharset::UTF8,
    ) {
        parent::__construct(
            $statusCode,
            new ContentTypeHttpHeader(ApplicationMimeType::JSON, $charset)
        );
    }

    public function datalist(): iterable
    {
        return $this->datalist;
    }
}
