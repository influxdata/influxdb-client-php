<?php

namespace InfluxDB2Test;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use InfluxDB2\DefaultApi;
use InfluxDB2\Model\Query;
use InfluxDB2\Service\QueryService;
use InfluxDB2\Service\TelegrafsService;
use InfluxDB2\Service\WriteService;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * Header parameters (Accept, Content-Type) take precedence over the default headers of the operation.
 */
class ServiceHeaderParamsTest extends TestCase
{
    /** @var DefaultApi */
    private $defaultApi;
    /** @var MockHandler */
    private $mockHandler;
    /** @var \ArrayObject<int, RequestInterface> */
    private $requests;

    public function setUp(): void
    {
        $this->defaultApi = new DefaultApi(['url' => 'http://localhost:8086', 'token' => 'my-token']);
        $this->mockHandler = new MockHandler();
        /** @var \ArrayObject<int, RequestInterface> $requests */
        $requests = new \ArrayObject();
        $this->requests = $requests;
        $handlerStack = HandlerStack::create($this->mockHandler);
        $handlerStack->push(Middleware::mapRequest(function (RequestInterface $request) use ($requests) {
            $requests[] = $request;
            return $request;
        }));
        $this->defaultApi->http = $this->defaultApi->configuredClient(new \GuzzleHttp\Client(['handler' => $handlerStack]));
    }

    public function testAcceptOfTelegrafConfiguration(): void
    {
        $toml = "[agent]\n  interval = \"10s\"\n";
        $this->mockHandler->append(
            new Response(200, ['Content-Type' => 'application/toml'], $toml),
            new Response(200, ['Content-Type' => 'application/json'], '{"id":"0123"}')
        );
        $service = new TelegrafsService($this->defaultApi);

        self::assertSame($toml, $service->getTelegrafsID('0123', 'span'));
        self::assertSame('{"id":"0123"}', $service->getTelegrafsID('0123', null, 'application/json'));

        self::assertCount(2, $this->requests);
        self::assertSame('application/toml', $this->requests[0]->getHeaderLine('Accept'));
        self::assertSame('span', $this->requests[0]->getHeaderLine('Zap-Trace-Span'));
        self::assertSame('application/json', $this->requests[1]->getHeaderLine('Accept'));
    }

    public function testContentTypeOfWrite(): void
    {
        $this->mockHandler->append(new Response(204));

        (new WriteService($this->defaultApi))->postWrite('my-org', 'my-bucket', 'mem,tag=a value=1');

        self::assertCount(1, $this->requests);
        self::assertSame('text/plain; charset=utf-8', $this->requests[0]->getHeaderLine('Content-Type'));
        self::assertSame('application/json', $this->requests[0]->getHeaderLine('Accept'));
        self::assertSame('mem,tag=a value=1', (string) $this->requests[0]->getBody());
    }

    public function testContentTypeOfQuery(): void
    {
        $this->mockHandler->append(
            new Response(200, ['Content-Type' => 'text/csv'], ''),
            new Response(200, ['Content-Type' => 'text/csv'], '')
        );
        $service = new QueryService($this->defaultApi);
        $query = new Query(['query' => 'buckets()']);

        $service->postQuery(null, 'identity', 'application/json', 'my-org', null, $query);
        $service->postQuery(null, 'gzip', null, 'my-org', null, $query);

        self::assertCount(2, $this->requests);
        self::assertSame('application/json', $this->requests[0]->getHeaderLine('Content-Type'));
        self::assertSame('identity', $this->requests[0]->getHeaderLine('Accept-Encoding'));
        self::assertSame('{"query":"buckets()"}', (string) $this->requests[0]->getBody());
        self::assertSame('application/json', $this->requests[1]->getHeaderLine('Content-Type'));
        self::assertSame('gzip', $this->requests[1]->getHeaderLine('Accept-Encoding'));
    }
}
