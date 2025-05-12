<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskService
{
    /**
     * @param TaskRepository $taskRepo
     */
    public function __construct(protected TaskRepository $taskRepo)
    {}

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters): mixed
    {
        return $this->taskRepo->all($filters);
    }

    /**
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task
    {
        return $this->taskRepo->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Task
     */
    public function update(int $id, array $data): Task
    {
        return $this->taskRepo->update($id, $data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->taskRepo->delete($id);
    }

    /**
     * @param int $id
     * @return Task|null
     */
    public function get(int $id): ?Task
    {
        return $this->taskRepo->find($id);
    }
}
