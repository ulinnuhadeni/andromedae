<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequestValidation;
use App\Http\Requests\Task\UpdateTaskRequestValidation;
use App\Http\Services\Task\TaskService;

class TaskController extends Controller
{
    protected $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            return $this->service->index();
        } catch (\Throwable $th) {
            return $this->failedResponse($th->getMessage());
        }
    }

    public function store(StoreTaskRequestValidation $request)
    {
        try {
            $inputData = $request->validated();

            return $this->service->store($inputData);
        } catch (\Throwable $th) {
            return $this->failedResponse($th->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return $this->service->show($id);
        } catch (\Throwable $th) {
            return $this->failedResponse($th->getMessage());
        }
    }

    public function update(UpdateTaskRequestValidation $request, $id)
    {
        try {
            $inputData = $request->validated();

            return $this->service->update($inputData, $id);
        } catch (\Throwable $th) {
            return $this->failedResponse($th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return $this->service->destroy($id);
        } catch (\Throwable $th) {
            return $this->failedResponse($th->getMessage());
        }
    }
}
