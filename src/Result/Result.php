<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result;

use Tuzex\Symfony\Responder\Http\Header\Header;
use Tuzex\Symfony\Responder\Http\Headers;
use Tuzex\Symfony\Responder\Metadata\Metadata;

abstract class Result
{
    private HttpConfigs $httpConfigs;
    private MetadataSet $metadataSet;

    public function __construct(HttpConfigs $httpConfigs)
    {
        $this->httpConfigs = $httpConfigs;
        $this->metadataSet = new MetadataSet();
    }

    public function getHttpConfigs(): HttpConfigs
    {
        return $this->httpConfigs;
    }

    public function getMetadataSet(): MetadataSet
    {
        return $this->metadataSet;
    }

    public function mountHeader(Header ...$headers): void
    {
        $this->httpConfigs = $this->httpConfigs->joinHeaders(new Headers(...$headers));
    }

    public function attachMetadata(Metadata ...$set): void
    {
        $this->metadataSet = $this->metadataSet->push(...$set);
    }
}
