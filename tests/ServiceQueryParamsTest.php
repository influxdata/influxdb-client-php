<?php

namespace InfluxDB2Test;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use InfluxDB2\DefaultApi;
use InfluxDB2\Model\ReplicationCreationRequest;
use InfluxDB2\ObjectSerializer;
use InfluxDB2\Service\DashboardsService;
use InfluxDB2\Service\DBRPsService;
use InfluxDB2\Service\ReplicationsService;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class ServiceQueryParamsTest extends TestCase
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

    public function testToQueryValue(): void
    {
        self::assertSame('true', ObjectSerializer::toQueryValue(true));
        self::assertSame('false', ObjectSerializer::toQueryValue(false));
        self::assertSame('a,b', ObjectSerializer::toQueryValue(['a', 'b']));
        self::assertSame('value', ObjectSerializer::toQueryValue('value'));
        self::assertSame('2020-01-02T03:04:05+00:00', ObjectSerializer::toQueryValue(new \DateTime('2020-01-02T03:04:05+00:00')));
    }

    public function testBooleanQueryParameters(): void
    {
        $this->mockHandler->append(
            new Response(201, ['Content-Type' => 'application/json'], '{}'),
            new Response(200, ['Content-Type' => 'application/json'], '{"dashboards":[]}'),
            new Response(200, ['Content-Type' => 'application/json'], '{"content":[]}')
        );

        $replication = new ReplicationCreationRequest([
            'name' => 'my-replication',
            'org_id' => '0123',
            'remote_id' => '0124',
            'local_bucket_id' => '0125',
            'remote_bucket_id' => '0126',
        ]);
        (new ReplicationsService($this->defaultApi))->postReplication($replication, null, true);
        (new DashboardsService($this->defaultApi))->getDashboards(null, null, 20, true);
        (new DBRPsService($this->defaultApi))->getDBRPs(null, null, null, null, null, false);

        self::assertCount(3, $this->requests);
        self::assertSame('validate=true', $this->requests[0]->getUri()->getQuery());
        self::assertStringContainsString('descending=true', $this->requests[1]->getUri()->getQuery());
        self::assertSame('default=false', $this->requests[2]->getUri()->getQuery());
    }
}
