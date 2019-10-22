<?php

namespace App\General\Abstracts;

use App\General\Interfaces\RepositoriesInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 * @package App\Repositories
 *
 * @property Model $_model
 */
abstract class RepositoryAbstract implements RepositoriesInterface
{
    protected $_model;

    /**
     * @param Model $model
     */
    public function setModel(Model $model){
        $this->_model = $model;
    }

    /**
     * @return Model
     */
    public function getModel(){
        return $this->_model;
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    protected function findById($id, $columns = ['*'])
    {
        return $this->getModel()->findOrFail($id, $columns);
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function all($columns = ['*'])
    {
        return $this->getModel()->all($columns);
    }

    /**
     * @param null $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? 50 : (int)$limit;
        return $this->getModel()->paginate($limit, $columns);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id = null, $columns = ['*'])
    {
        $fields = request()->get('fields');
        if ($fields) {
            $columns = explode(',', $fields);
        }

        return $this->findById($id, $columns);
    }

    /**
     * @param array $input
     * @return Model
     * @throws \Throwable
     */
    public function create(array $input = [])
    {
        $this->getModel()->fill($input)->saveOrFail();
        return $this->getModel();
    }

    /**
     * @param array $input
     * @param null $id
     * @return Model
     */
    public function update(array $input = [], $id = null)
    {
        $this->findById($id)->fill($input)->saveOrFail();
        return $this->getModel();
    }

    /**
     * @param null $id
     * @return int
     */
    public function destroy($id = null)
    {
        return $this->findById($id)->destroy($id);
    }
}
