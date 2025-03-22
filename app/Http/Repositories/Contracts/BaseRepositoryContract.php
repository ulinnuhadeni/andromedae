<?php

namespace App\Http\Repositories\Contracts;

interface BaseRepositoryContract
{
    public function index();

    public function store($inputData);

    public function bulkStore($inputData);

    public function findByColumn($column, $params);

    public function getByColumn($column, $params);

    public function find($id);

    public function update($id, $inputData);

    public function checkUpdateOrCreate($arrayCheck, $inputData);

    public function destroy($id);
}
