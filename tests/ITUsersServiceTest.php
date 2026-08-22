<?php

namespace InfluxDB2Test;

use InfluxDB2\Model\User;
use InfluxDB2\Model\Users;
use InfluxDB2\Service\UsersService;

require_once('IntegrationBaseTestCase.php');

/**
 * @group integration
 */
class ITUsersServiceTest extends IntegrationBaseTestCase
{
    public function testUserService(): void
    {
        $usersService = $this->client->createService(UsersService::class);
        self::assertInstanceOf(UsersService::class, $usersService);
        $users = $usersService->getUsers();
        self::assertInstanceOf(Users::class, $users);
        foreach ($users->getUsers() as $user) {
            self::assertInstanceOf(User::class, $user);
            self::assertNotEmpty($user->getName());
            self::assertNotEmpty($user->getId());
            self::assertNotEmpty($user->getLinks()->getSelf());
        }
    }
}
