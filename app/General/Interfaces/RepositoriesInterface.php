<?php

namespace App\General\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoriesInterface
{
    public function getModel();

    public function setModel(Model $model);

    public function all($columns = ['*']);

    public function find($id, $columns = ['*']);

    public function paginate($limit = null, $columns = ['*']);

    public function create(array $input = []);

    public function update(array $input = [], $id = null);

    public function destroy($id = null);
}
