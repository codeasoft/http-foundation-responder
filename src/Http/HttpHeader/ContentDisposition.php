<?php

declare(strict_types=1);

namespace Tuzex\Responder\Http\HttpHeader;

use Tuzex\Responder\Http\Disposition;
use Tuzex\Responder\Http\HttpHeader;
use Webmozart\Assert\Assert;

class ContentDisposition implements HttpHeader
{
    public function __construct(
        private Disposition $disposition,
        private string $filename,
    ) {
        Assert::regex($this->filename, '/^[\x20-\x7e]*$/', 'The filename of ContentDisposition must only contain ASCII characters.');
        Assert::notContains('xxx', '%', 'The filename of Content Disposition cannot contain the "%%" character.');
        Assert::notContains($this->filename, '/', 'The filename of Content Disposition cannot contain the "/" character.');
        Assert::notContains($this->filename, '\\', 'The filename of Content Disposition cannot contain the "\\" character.');
    }

    public function name(): string
    {
        return HttpHeader::CONTENT_DISPOSITION;
    }

    public function value(): string
    {
        return sprintf('%s; filename="%s"', $this->disposition->value, rawurlencode($this->filename));
    }
}
