<?php

namespace App\Domain\Repository\Eloquent;

use App\Domain\Contracts\UsersContract;
use App\Models\User;

class UsersRepository implements UsersContract
{
    /**
     * @param $query
     * @return \Illuminate\Support\Collection
     */
    public function fetchAll($query)
    {
        return User::all();
    }

    /**
     * @param int $id
     * @return \App\Models\User
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail($email)
    {
        return User::withTrashed()->whereEmail($email)->first();
    }

    /**
     * @param array $params
     * @return \App\Models\User
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function create(array $params)
    {
        $user = (new User())->fill($params);
        $user->save();
    
        return $user;
    }

    /**
     * @param User $user
     * @param array $params
     * @return \App\Models\User
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function update(User $user, array $params)
    {
        $user->fill([
            'email' => $params['email'],
            'name' => $params['name']
        ]);

        $user->save();

        return $user;
    }

    /**
     * @param User $user
     * @return \App\Models\User
     * @throws \Exception
     */
    public function delete(User $user)
    {
        return $user->delete();
    }

    /**
     * @param User $user
     * @return \App\Models\User
     * @throws \Exception
     */
    public function restore(User $user)
    {
        return $user->restore();
    }
}