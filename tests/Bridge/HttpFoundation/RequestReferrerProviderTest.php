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
     * @dataProvider provideData
     */
    public function testItReturnsReferrer(RequestStack $requestStack, string $expectedReferrer): void
    {
        $referrerProvider = new RequestReferrerProvider(
            new RequestAccessor($requestStack)
        );

        $this->assertSame($expectedReferrer, $referrerProvider->provide());
    }

    public function provideData(): array
    {
        $host = 'host.com';
        $headers = [
            'without-referrer' => [
                'host' => $host,
                'referer' => sprintf('http://%s/', $host),
            ],
            'with-referrer' => [
                'host' => $host,
                'referer' => 'https://referrer.com/',
            ],
        ];

        return array_map(function (array $data): array {
            $request = new Request();
            $request->headers->add($data);

            $requestStack = new RequestStack();
            $requestStack->push($request);

            return [
                'requestStack' => $requestStack,
                'expectedReferrer' => $data['referer'],
            ];
        }, $headers);
    }
}
