<?php

declare(strict_types=1);

namespace Querify\Infrastructure\Task\Adapter;

use Doctrine\DBAL\DriverManager;
use Querify\Domain\Demand\Demand;
use Querify\Domain\ExternalService\ExternalService;
use Querify\Domain\Task\Task;
use Querify\Infrastructure\Task\Adapter;
use Querify\Infrastructure\Task\FileHandler\FileHandler;

class Postgres implements Adapter
{
    public function __construct(private readonly FileHandler $fileHandler) {}

    public function execute(Demand $demand, ExternalService $externalService): Task
    {
        $start = microtime(true);

        try {
            $connection = DriverManager::getConnection(
                [
                    'dbname' => $externalService->serviceName,
                    'user' => $externalService->user,
                    'password' => $externalService->password,
                    'host' => $externalService->host,
                    'port' => $externalService->port,
                    'driver' => 'pdo_pgsql',
                ]
            );

            $result = $connection->executeQuery($demand->content);
        } catch (\Exception $e) {
            return new Task(
                $demand,
                success: false,
                executionTime: (int) ((microtime(true) - $start) * 1000),
            );
        }
        $executionTime = (int) ((microtime(true) - $start) * 1000);

        $rowCount = $result->rowCount();
        $data = $result->fetchAllAssociative();

        $adapterResult = new AdapterResult(
            columnNames: array_keys($data[0]),
            rowCount: $rowCount,
            executionTime: $executionTime,
            data: $data,
        );

        return new Task(
            $demand,
            success: true,
            executionTime: $executionTime,
            resultPath: $this->fileHandler->save($demand, $adapterResult),
        );
    }
}
