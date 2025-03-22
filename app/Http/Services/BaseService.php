<?php

namespace App\Http\Services;

use App\Http\Repositories\Contracts\BaseRepositoryContract;
use App\Traits\ResponseTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseService
{
    use ResponseTrait;

    protected $repository;

    protected $responseMessages;

    protected $resource;

    public function __construct(BaseRepositoryContract $repository, JsonResource $resource)
    {
        $this->resource = $resource;
        $this->repository = $repository;
        $this->responseMessages = $this->responseMessages;
    }

    public function index()
    {
        $data = $this->repository->index();

        $results = $this->resource::collection($data);

        return $this->successResponse($this->responseMessages['index-success'], 200, [
            'data' => $results,
        ]);
    }

    public function show($id)
    {
        $data = $this->repository->find($id);

        $result = new $this->resource($data);

        if (! $data) {
            return $this->failedResponse('Data Not Found', 404);
        }

        return $this->successResponse($this->responseMessages['show-success'], 200, [
            'data' => $result,
        ]);
    }

    public function store(array $request)
    {
        $storedData = $this->repository->store($request);

        return $this->successResponse($this->responseMessages['store-success'], 201, [
            'data' => $storedData,
        ]);
    }

    public function update(array $request, $id)
    {
        $updatedData = $this->repository->update($id, $request);

        return $this->successResponse($this->responseMessages['update-success'], 200, [
            'data' => $updatedData,
        ]);
    }

    public function destroy($id)
    {
        $this->repository->destroy($id);

        return $this->successResponse($this->responseMessages['destroy-success'], 200);
    }
}
