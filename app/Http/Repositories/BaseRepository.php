<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\BaseRepositoryContract;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryContract
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->model->all();
    }

    public function store($inputData)
    {
        return $this->model->create($inputData);
    }

    public function bulkStore($inputData)
    {
        return $this->model->insert($inputData);
    }

    public function findByColumn($column, $params)
    {
        return $this->model->where($column, $params)->first();
    }

    public function getByColumn($column, $params)
    {
        return $this->model->where($column, $params)->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update($id, $inputData)
    {
        return $this->find($id)->update($inputData);
    }

    public function checkUpdateOrCreate($arrayCheck, $inputData)
    {
        return $this->model->updateOrCreate($arrayCheck, $inputData);
    }

    public function destroy($id)
    {
        return $this->find($id)->delete();
    }
}
