<?php

namespace InfluxDB2Test;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use InfluxDB2\DefaultApi;
use InfluxDB2\Model\PasswordResetBody;
use InfluxDB2\Service\SecurityAndAccessEndpointsService;
use InfluxDB2\Service\SigninService;
use InfluxDB2\Service\UsersService;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * Endpoints which use HTTP basic authentication passed by the $authorization parameter.
 */
class BasicAuthEndpointsTest extends TestCase
{
    private const BASIC_AUTH = 'Basic bXktdXNlcjpteS1wYXNzd29yZA==';

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

    public function testSignin(): void
    {
        $this->mockHandler->append(new Response(204));

        (new SigninService($this->defaultApi))->postSignin(null, self::BASIC_AUTH);

        $this->assertRequest('POST', '/api/v2/signin', self::BASIC_AUTH);
    }

    public function testPostUsersIDPassword(): void
    {
        $this->mockHandler->append(new Response(204), new Response(204));
        $body = new PasswordResetBody(['password' => 'new-password']);

        (new UsersService($this->defaultApi))->postUsersIDPassword('0123', $body);
        $this->assertRequest('POST', '/api/v2/users/0123/password', 'Token my-token');

        (new SecurityAndAccessEndpointsService($this->defaultApi))->postUsersIDPassword('0123', $body);
        $this->assertRequest('POST', '/api/v2/users/0123/password', 'Token my-token', 1);
        self::assertSame('{"password":"new-password"}', (string) $this->requests[1]->getBody());
    }

    public function testPutMePassword(): void
    {
        $this->mockHandler->append(new Response(204));

        (new UsersService($this->defaultApi))->putMePassword(new PasswordResetBody(['password' => 'new-password']), null, self::BASIC_AUTH);

        $this->assertRequest('PUT', '/api/v2/me/password', self::BASIC_AUTH);
        self::assertSame('{"password":"new-password"}', (string) $this->requests[0]->getBody());
    }

    private function assertRequest(string $method, string $path, string $authorization, int $index = 0): void
    {
        self::assertArrayHasKey($index, $this->requests);
        $request = $this->requests[$index];
        self::assertSame($method, $request->getMethod());
        self::assertSame($path, $request->getUri()->getPath());
        self::assertSame([$authorization], $request->getHeader('Authorization'));
    }
}
