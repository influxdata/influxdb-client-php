<?php

use InfluxDB2\Service\UsersService;

require_once('IntegrationBaseTestCase.php');

/**
 * @group integration
 */
class ITUsersServiceTest extends IntegrationBaseTestCase
{
    public function testUserService()
    {
        /** @var UsersService $usersService */
        $usersService = $this->client->createService(UsersService::class);
        $users = $usersService->getUsers()->getUsers();
        foreach ($users as $user) {
            self::assertNotEmpty($user->getName());
            self::assertNotEmpty($user->getId());
            self::assertNotEmpty($user->getLinks()->getSelf());
        }
    }
}
