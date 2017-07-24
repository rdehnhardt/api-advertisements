<?php

namespace App\Console\Commands\Import\Models;

use Illuminate\Database\Eloquent\Model;

class MontadoraCategoria extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'montadora_categoria';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'advertise';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function montadora()
    {
        return $this->belongsTo(Montadora::class, 'id_montadora', 'id_montadora');
    }
}
