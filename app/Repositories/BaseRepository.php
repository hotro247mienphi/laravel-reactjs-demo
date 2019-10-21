<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 * @package App\Repositories
 *
 * @property Model $model
 */
abstract class BaseRepository implements RepositoriesInterface
{
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    protected function findById($id, $columns = ['*'])
    {
        return $this->model()->findOrFail($id, $columns);
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function all($columns = ['*'])
    {
        // TODO: Implement all() method.
        return $this->model()->all($columns);
    }

    /**
     * @param null $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        // TODO: Implement paginate() method.
        $limit = is_null($limit) ? 50 : (int)$limit;
        return $this->model()->paginate($limit, $columns);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        // TODO: Implement find() method.
        return $this->findById($id, $columns);
    }

    /**
     * @param array $input
     * @return bool
     * @throws \Throwable
     */
    public function create(array $input = [])
    {
        // TODO: Implement create() method.
        return $this->model()->saveOrFail($input);
    }

    /**
     * @param array $input
     * @param null $id
     * @return $this
     */
    public function update(array $input = [], $id = null)
    {
        // TODO: Implement update() method.
        $this->findById($id)->fill($input)->saveOrFail();
        return $this->model();
    }

    /**
     * @param null $id
     * @return int
     */
    public function destroy($id = null)
    {
        // TODO: Implement destroy() method.
        return $this->findById($id)->destroy($id);
    }
}
