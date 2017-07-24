<?php

namespace App\Console\Commands\Import\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pessoa';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'advertise';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function anuncios()
    {
        return $this->hasMany(Anuncio::class, 'id_pessoa', 'id_pessoa');
    }
}
