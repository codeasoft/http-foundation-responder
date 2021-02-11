<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

abstract class Content extends Result
{
    private string $textBody;

    protected function __construct(string $textBody, HttpConfig $httpConfig)
    {
        $this->textBody = $textBody;

        parent::__construct($httpConfig);
    }

    public function textBody(): string
    {
        return $this->textBody;
    }
}
