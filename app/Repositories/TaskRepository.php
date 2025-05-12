<?php
namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    /**
     * @param array $filters
     * @return mixed
     */
    public function all(array $filters = []): mixed
    {
        return Task::query()->filter($filters)->paginate($filters['per_page'] ?? 15);
    }

    /**
     * @param int $id
     * @return Task|null
     */
    public function find(int $id): ?Task
    {
        return Task::find($id);
    }

    /**
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task
    {
        return Task::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Task
     */
    public function update(int $id, array $data): Task
    {
        $task = $this->find($id);
        $task->update($data);

        return $task;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $task = $this->find($id);
        $task->delete();
    }
}
