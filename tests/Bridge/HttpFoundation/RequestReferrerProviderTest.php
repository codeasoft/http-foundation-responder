<?php

declare(strict_types=1);

namespace Tuzex\Responder\Test\Bridge\HttpFoundation;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Tuzex\Responder\Bridge\HttpFoundation\RequestAccessor;
use Tuzex\Responder\Bridge\HttpFoundation\RequestReferrerProvider;

final class RequestReferrerProviderTest extends TestCase
{
    /**
     * @dataProvider provideRequestData
     */
    public function testItReturnsReferrer(RequestStack $requestStack, string $expectedReferrer): void
    {
        $referrerProvider = new RequestReferrerProvider(
            new RequestAccessor($requestStack)
        );

        $this->assertSame($expectedReferrer, $referrerProvider->provide());
    }

    public function provideRequestData(): array
    {
        $host = 'host.com';
        $referrer = 'https://referrer.com';

        $headers = [
            'without-referrer' => [
                'host' => $host,
            ],
            'with-referrer' => [
                'host' => $host,
                'referrer' => $referrer,
            ],
        ];

        return array_map(function (array $data): array {
            $request = new Request();
            $request->headers->add([
                'host' => $data['host'],
                'referer' => $data['referrer'] ?? '',
            ]);

            $requestStack = new RequestStack();
            $requestStack->push($request);

            return [
                'requestStack' => $requestStack,
                'expectedReferrer' => $data['referrer'] ?? sprintf('http://%s', $data['host']),
            ];
        }, $headers);
    }
}
