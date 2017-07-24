<?php

namespace App\Console\Commands\Import\Models;

use Illuminate\Database\Eloquent\Model;

class Montadora extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'montadora';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'advertise';
}
