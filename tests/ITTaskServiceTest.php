<?php

namespace InfluxDB2Test;

use InfluxDB2\Model\Task;
use InfluxDB2\Model\TaskCreateRequest;
use InfluxDB2\Service\TasksService;

require_once('IntegrationBaseTestCase.php');

/**
 * @group integration
 */
class ITTaskServiceTest extends IntegrationBaseTestCase
{
    public function testCreateTask(): void
    {
        $taskService = $this->client->createService(TasksService::class);
        self::assertInstanceOf(TasksService::class, $taskService);

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

        self::assertInstanceOf(Task::class, $task);
        self::assertEquals("task-name", $task->getName());
    }
}
