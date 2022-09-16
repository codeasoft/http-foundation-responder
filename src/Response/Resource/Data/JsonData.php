<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\Resource\Data;

use Codea\SmartReply\Http\Charset;
use Codea\SmartReply\Http\Charset\UnicodeCharset;
use Codea\SmartReply\Http\HttpHeader\ContentTypeHttpHeader;
use Codea\SmartReply\Http\MimeType\ApplicationMimeType;
use Codea\SmartReply\Http\StatusCode;
use Codea\SmartReply\Response\Resource;
use Codea\SmartReply\Response\Resource\Data;

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
