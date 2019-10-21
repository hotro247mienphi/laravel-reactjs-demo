<?php


namespace App\Repositories;


use App\User;

/**
 * Class UserRepository
 * @package App\Repositories
 *
 * @property User $model
 */
class UserRepository extends BaseRepository
{

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function all($columns = ['*'])
    {
        return $this->model()->get($columns);
    }

    /**
     * @param null $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        return $this->model()
            ->latest()
            ->activate()
            ->isGmail()
            ->paginate($limit, $columns);
    }

}
