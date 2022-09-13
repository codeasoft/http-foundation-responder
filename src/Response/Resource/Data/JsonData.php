<?php

declare(strict_types=1);

namespace Codea\Responder\Response\Resource\Data;

use Codea\Responder\Http\Charset;
use Codea\Responder\Http\Charset\UnicodeCharset;
use Codea\Responder\Http\HttpHeader\ContentTypeHttpHeader;
use Codea\Responder\Http\MimeType\ApplicationMimeType;
use Codea\Responder\Http\StatusCode;
use Codea\Responder\Response\Resource;
use Codea\Responder\Response\Resource\Data;

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
