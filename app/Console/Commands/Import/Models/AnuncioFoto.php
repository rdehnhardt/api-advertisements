<?php

namespace App\Console\Commands\Import\Models;

use App\Domain\Service\AdvertisementService;
use App\Domain\Service\PictureService;
use App\Domain\Service\UserService;
use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Model;

class AnuncioFoto extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anuncio_foto';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'advertise';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anuncio()
    {
        return $this->belongsTo(Anuncio::class, 'id_anuncio', 'id_anuncio');
    }

    /**
     * Convert to user
     */
    public function convert(Advertisement $advertisement)
    {
        return app(PictureService::class)->create($user, [
            'title' => ucwords(strtolower($title)),
            'description' => $this->observacao,
            'price' => $this->valor,
            'tags' => str_replace(' ', ',', strtolower($this->resumo)),
        ]);
    }
}
