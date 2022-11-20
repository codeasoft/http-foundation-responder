<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource\Redirect;

use Assert\Assertion as Assert;
use Termyn\SmartReply\Http\StatusCode;
use Termyn\SmartReply\Response\Resource\Redirect;

final class UrlRedirect extends Redirect
{
    public function __construct(
        public readonly string $url,
        StatusCode $statusCode = StatusCode::FOUND
    ) {
        Assert::url($url);

        parent::__construct($statusCode);
    }
}
