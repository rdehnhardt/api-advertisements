<?php

namespace App\Domain\Service;

use App\Domain\Contracts\UsersContract;
use App\Models\User;
use DB;

class UserService
{
    /**
     * @var UsersContract
     */
    private $repository;

    /**
     * UserService constructor.
     * @param UsersContract $repository
     */
    public function __construct(UsersContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $query
     * @return \Illuminate\Support\Collection
     */
    public function fetchAll($query)
    {
        return $this->repository->fetchAll($query);
    }

    /**
     * @param int $id
     * @return \App\Models\User
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }


    /**
     * @param string $email
     * @return \App\Models\User
     */
    public function getByEmail($email)
    {
        return $this->repository->findByEmail($email);
    }


    /**
     * @param array $params
     * @return \App\Models\User
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function create(array $params)
    {
        return DB::transaction(function () use ($params) {
            if ($user = $this->repository->findByEmail($params['email'], true)) {
                $this->repository->restore($user);

                return $user;
            }

            return $this->repository->create($params);
        });
    }

    /**
     * @param User $user
     * @param array $params
     * @return \App\Models\User
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function update(User $user, array $params)
    {
        $this->repository->update($user, $params);

        return $user;
    }

    /**
     * @param string $id
     * @return \App\Models\User
     * @throws \Exception
     */
    public function delete($id)
    {
        $user = $this->get($id);
        $this->repository->delete($user);

        return $user;
    }
}
