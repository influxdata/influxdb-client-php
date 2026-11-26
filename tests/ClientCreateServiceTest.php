<?php

namespace InfluxDB2Test;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use InfluxDB2\Client;
use InfluxDB2\Model\Buckets;
use InfluxDB2\Service\BucketsService;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class ClientCreateServiceTest extends TestCase
{
    public function testCreateService(): void
    {
        $mockHandler = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], '{"buckets":[{"name":"my-bucket"}]}'),
        ]);
        /** @var \ArrayObject<int, RequestInterface> $requests */
        $requests = new \ArrayObject();
        $handlerStack = HandlerStack::create($mockHandler);
        $handlerStack->push(Middleware::mapRequest(function (RequestInterface $request) use ($requests) {
            $requests[] = $request;
            return $request;
        }));
        $client = new Client([
            'url' => 'http://localhost:8086',
            'token' => 'my-token',
            'httpClient' => new \GuzzleHttp\Client(['handler' => $handlerStack]),
        ]);

        $service = $client->createService(BucketsService::class);
        self::assertInstanceOf(BucketsService::class, $service);

        // the service uses the options of the client
        $buckets = $service->getBuckets();
        self::assertInstanceOf(Buckets::class, $buckets);
        self::assertSame('my-bucket', ($buckets->getBuckets() ?? [])[0]->getName());
        self::assertCount(1, $requests);
        self::assertSame('http://localhost:8086/api/v2/buckets?limit=20', (string) $requests[0]->getUri());
        self::assertSame('Token my-token', $requests[0]->getHeaderLine('Authorization'));
    }
}
