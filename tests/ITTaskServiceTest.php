<?php

use InfluxDB2\Model\TaskCreateRequest;
use InfluxDB2\Service\TasksService;

require_once('IntegrationBaseTestCase.php');

/**
 * @group integration
 */
class ITTaskServiceTest extends IntegrationBaseTestCase
{
    public function testCreateTask()
    {
        /** @var TasksService $taskService */
        $taskService = $this->client->createService(TasksService::class);

        $flux = "option task = {
  name: \"task-name\",
  every: 6h
}
from(bucket: \"telegraf\") |> range(start: -1h)
";

        $taskCreateRequest = new TaskCreateRequest();
        $taskCreateRequest
            ->setFlux($flux)
            ->setOrgId($this->findMyOrg()->getId());

        $task = $taskService->postTasks($taskCreateRequest);

        self::assertEquals("task-name", $task->getName());
    }
}
