<?php

namespace App\General\Repositories;

use App\General\Abstracts\RepositoryAbstract;
use App\User;

/**
 * Class UserRepository
 * @package App\Repositories
 *
 */
class UserRepository extends RepositoryAbstract
{

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->_model = $model;
    }

    /**
     * @param null $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? 50 : (int)$limit;

        return $this->getModel()
            ->activate()
            ->mailIn(['gmail.com', 'yahoo.com', 'hotmail.com'])
            ->latest()
            ->paginate($limit, $columns);
    }

}
