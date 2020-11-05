<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Service;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Tuzex\Responder\Bridge\HttpFoundation\RequestAccessor;
use Tuzex\Responder\Service\UriProvider;

final class UriProviderTest extends TestCase
{
    /**
     * @dataProvider provideRequestData
     */
    public function testItReturnsUri(RequestStack $requestStack, string $expectedUri): void
    {
        $uriProvider = new UriProvider(
            new RequestAccessor($requestStack)
        );

        $this->assertEquals($expectedUri, $uriProvider->provide());
    }

    public function provideRequestData(): array
    {
        $host = 'host.com';
        $headers = [
            'only-domain' => [
                'host' => $host,
                'uri'=> sprintf('http://%s/', $host),
            ],
        ];

        return array_map(function (array $data): array {
            $request = new Request();
            $request->headers->add([
                'host' => $data['host'],
            ]);

            $requestStack = new RequestStack();
            $requestStack->push($request);

            return [
                'requestStack' => $requestStack,
                'expectedUri' => $data['uri']
            ];
        }, $headers);
    }
}
