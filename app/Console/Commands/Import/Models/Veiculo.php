<?php

namespace App\Console\Commands\Import\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'veiculo';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'advertise';

    public function categoria()
    {
        return $this->belongsTo(MontadoraCategoria::class, 'id_montadora_categoria', 'id_montadora_categoria');
    }
}
