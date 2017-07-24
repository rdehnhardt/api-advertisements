<?php

namespace App\Domain\Contracts;

use App\Models\Advertisement;
use App\Models\Picture;

interface PicturesContract
{
    /**
     * @param Advertisement $advertisement
     * @return \Illuminate\Support\Collection
     */
    public function fetchAllByAdvertisement(Advertisement $advertisement);

    /**
     * @param Advertisement $advertisement
     * @param string $name
     * @return Picture
     */
    public function find(Advertisement $advertisement, $name);

    /**
     * @param Advertisement $advertisement
     * @param array $params
     * @return Picture
     */
    public function create(Advertisement $advertisement, array $params);

    /**
     * @param Picture $picture
     * @return Picture
     */
    public function delete(Picture $picture);
}