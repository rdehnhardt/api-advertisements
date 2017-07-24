<?php

namespace App\Domain\Repository\Eloquent;

use App\Domain\Contracts\PicturesContract;
use App\Models\Advertisement;
use App\Models\Picture;

class PicturesRepository implements PicturesContract
{
    /**
     * @param Advertisement $advertisement
     * @return \Illuminate\Support\Collection
     */
    public function fetchAllByAdvertisement(Advertisement $advertisement)
    {
        return $advertisement->pictures;
    }

    /**
     * @param Advertisement $advertisement
     * @param string $name
     * @return Picture
     */
    public function find(Advertisement $advertisement, $name)
    {
        return $advertisement->pictures()->whereFile($name)->first();
    }

    /**
     * @param Advertisement $advertisement
     * @param array $params
     * @return Picture
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function create(Advertisement $advertisement, array $params)
    {
        $picture = (new Picture())->fill($params);
        $advertisement->pictures()->save($picture);

        return $picture;
    }

    /**
     * @param Picture $picture
     * @return bool
     * @throws \Exception
     */
    public function delete(Picture $picture)
    {
        return $picture->delete();
    }
}