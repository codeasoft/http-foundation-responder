<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Tuzex\Responder\Http\Header;
use Tuzex\Responder\Http\Headers;
use Tuzex\Responder\Result\HttpConfig;
use Tuzex\Responder\Result\Metadata;
use Tuzex\Responder\Result\MetadataSet;

abstract class Result
{
    private HttpConfig $httpConfig;
    private MetadataSet $metadataSet;

    public function __construct(HttpConfig $httpConfig)
    {
        $this->httpConfig = $httpConfig;
        $this->metadataSet = new MetadataSet();
    }

    public function getHttpConfig(): HttpConfig
    {
        return $this->httpConfig;
    }

    public function getMetadataSet(): MetadataSet
    {
        return $this->metadataSet;
    }

    public function addHeader(Header ...$headers): void
    {
        $this->httpConfig = $this->httpConfig->joinHeaders(new Headers(...$headers));
    }

    public function addMetadata(Metadata ...$set): void
    {
        $this->metadataSet = $this->metadataSet->push(...$set);
    }
}
