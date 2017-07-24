<?php

namespace App\Domain\Service;

use App\Domain\Contracts\AdvertisementsContract;
use App\Models\User;
use Illuminate\Support\Collection;

class AdvertisementService
{
    /**
     * @var AdvertisementsContract
     */
    private $repository;

    /**
     * AdvertisementService constructor.
     * @param AdvertisementsContract $repository
     */
    public function __construct(AdvertisementsContract $repository)
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
     * @param User $user
     * @return \Illuminate\Support\Collection
     */
    public function fetchAllByUser(User $user)
    {
        return $this->repository->fetchAllByUser($user);
    }

    /**
     * @param string $uuid
     * @return \App\Models\Advertisement
     */
    public function get($uuid)
    {
        return $this->repository->find($uuid);
    }

    /**
     * @param User $user
     * @param string $uuid
     * @return \App\Models\Advertisement
     */
    public function getByUser(User $user, $uuid)
    {
        return $this->repository->findByUser($user, $uuid);
    }

    /**
     * @param User $user
     * @param array $params
     * @return \App\Models\Advertisement
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function create(User $user, array $params)
    {
        return $this->repository->create($user, $params);
    }

    /**
     * @param User $user
     * @param string $uuid
     * @param array $params
     * @return \App\Models\Advertisement
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function update(User $user, $uuid, array $params)
    {
        $advertisement = $this->getByUser($user, $uuid);
        $this->repository->updateByUser($user, $advertisement, $params);

        return $advertisement;
    }

    /**
     * @param User $user
     * @param string $uuid
     * @return \App\Models\Advertisement
     * @throws \Exception
     */
    public function delete(User $user, $uuid)
    {
        $advertisement = $this->getByUser($user, $uuid);
        $this->repository->delete($advertisement);

        return $advertisement;
    }

    /**
     * @param User $user
     * @param string $uuid
     * @return \App\Models\Advertisement
     * @throws \Exception
     */
    public function togglePublished(User $user, $uuid)
    {
        $advertisement = $this->getByUser($user, $uuid);
        $this->repository->togglePublished($user, $advertisement);

        return $advertisement;
    }

    /**
     * @param string $query
     * @return Collection
     */
    public function fetchPublished($query = '')
    {
        return $this->repository->fetchPublished($query);
    }
}
