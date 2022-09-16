<?php

declare(strict_types=1);

namespace Codea\SmartReply\Http\HttpHeader;

use Codea\SmartReply\Http\Disposition;
use Codea\SmartReply\Http\HttpHeader;
use Webmozart\Assert\Assert;

class ContentDispositionHttpHeader implements HttpHeader
{
    protected readonly string $filename;

    public function __construct(
        protected readonly Disposition $disposition,
        string $filename = '',
    ) {
        Assert::regex($filename, '/^[\x20-\x7e]*$/', 'The filename of ContentDisposition must only contain ASCII characters.');
        Assert::notContains($filename, '%', 'The filename of Content Disposition cannot contain the "%%" character.');
        Assert::notContains($filename, '/', 'The filename of Content Disposition cannot contain the "/" character.');
        Assert::notContains($filename, '\\', 'The filename of Content Disposition cannot contain the "\\" character.');

        $this->filename = rawurlencode($filename);
    }

    public function name(): string
    {
        return HttpHeader::CONTENT_DISPOSITION;
    }

    public function value(): string
    {
        return sprintf('%s%s', $this->disposition->value, $this->filename());
    }

    protected function filename(): string
    {
        return ! empty($this->filename) ? sprintf('; filename="%s"', $this->filename) : $this->filename;
    }
}
