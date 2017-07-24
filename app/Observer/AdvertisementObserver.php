<?php

namespace App\Observer;

use App\Models\Advertisement;
use Ramsey\Uuid\Uuid;
use Auth;

class AdvertisementObserver
{
    /**
     * Listen to the Advertisement created event.
     *
     * @param Advertisement $advertisement
     */
    public function creating(Advertisement $advertisement)
    {
        $advertisement->uuid = Uuid::uuid1();
    }
}