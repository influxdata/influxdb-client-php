<?php

namespace InfluxDB2Test;

use Http\Client\Common\Plugin\CookiePlugin;
use Http\Client\Common\PluginClient;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Message\CookieJar;
use InfluxDB2\ApiException;
use InfluxDB2\DefaultApi;
use InfluxDB2\Model\PasswordResetBody;
use InfluxDB2\Model\PostUser;
use InfluxDB2\Model\User;
use InfluxDB2\Service\SigninService;
use InfluxDB2\Service\UsersService;

require_once('IntegrationBaseTestCase.php');

/**
 * @group integration
 */
class ITSigninPasswordTest extends IntegrationBaseTestCase
{
    /** @var UsersService */
    private $usersService;
    /** @var string|null */
    private $userId;

    public function setUp(): void
    {
        parent::setUp();
        /** @var UsersService $usersService */
        $usersService = $this->client->createService(UsersService::class);
        $this->usersService = $usersService;
    }

    public function tearDown(): void
    {
        if ($this->userId !== null) {
            $this->usersService->deleteUsersID($this->userId);
        }
        $this->client->close();
    }

    public function testChangePassword(): void
    {
        $username = 'IT-php-user-' . uniqid();
        $user = $this->usersService->postUsers(new PostUser(['name' => $username]));
        self::assertInstanceOf(User::class, $user);
        $this->userId = (string) $user->getId();

        // the password of any user can be set by the token
        $this->usersService->postUsersIDPassword($this->userId, new PasswordResetBody(['password' => 'first-password']));

        self::assertSame(204, $this->signin($username, 'first-password'));
        self::assertSame(401, $this->signin($username, 'wrong-password'));

        // the own password is changed in a session with the old password
        $httpClient = new PluginClient(Psr18ClientDiscovery::find(), [new CookiePlugin(new CookieJar())]);
        $sessionApi = new DefaultApi(array_merge($this->options, ['httpClient' => $httpClient]));
        $basicAuth = 'Basic ' . base64_encode($username . ':first-password');
        (new SigninService($sessionApi))->postSignin(null, $basicAuth);
        (new UsersService($sessionApi))->putMePassword(new PasswordResetBody(['password' => 'second-password']), null, $basicAuth);

        self::assertSame(204, $this->signin($username, 'second-password'));
        self::assertSame(401, $this->signin($username, 'first-password'));
    }

    private function signin(string $username, string $password): int
    {
        /** @var SigninService $service */
        $service = $this->client->createService(SigninService::class);
        try {
            return $service->postSigninWithHttpInfo(null, 'Basic ' . base64_encode($username . ':' . $password))[1];
        } catch (ApiException $e) {
            return $e->getCode();
        }
    }
}
