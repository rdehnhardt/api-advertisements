<?php

namespace App\Domain\Contracts;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Support\Collection;

interface AdvertisementsContract
{
    /**
     * @param $query
     * @return \Illuminate\Support\Collection
     */
    public function fetchAll($query);

    /**
     * @param User $user
     * @return \Illuminate\Support\Collection
     */
    public function fetchAllByUser(User $user);

    /**
     * @param string $uuid
     * @return Advertisement
     */
    public function find($uuid);

    /**
     * @param User $user
     * @param string $uuid
     * @return Advertisement
     */
    public function findByUser($user, $uuid);

    /**
     * @param User $user
     * @param array $params
     * @return Advertisement
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function create(User $user, array $params);

    /**
     * @param Advertisement $advertisement
     * @param array $params
     * @return Advertisement
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function update(Advertisement $advertisement, array $params);

    /**
     * @param User $user
     * @param Advertisement $advertisement
     * @param array $params
     * @return Advertisement
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function updateByUser(User $user, Advertisement $advertisement, array $params);

    /**
     * @param Advertisement $advertisement
     * @return Advertisement
     * @throws \Exception
     */
    public function delete(Advertisement $advertisement);

    /**
     * @param User $user
     * @param Advertisement $advertisement
     * @return Advertisement
     * @throws \Exception
     */
    public function togglePublished(User $user, Advertisement $advertisement);

    /**
     * @param string $filter
     * @return Collection
     */
    public function fetchPublished($filter = '');
}