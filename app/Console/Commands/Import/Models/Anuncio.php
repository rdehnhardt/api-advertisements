<?php

namespace App\Console\Commands\Import\Models;

use App\Domain\Service\PictureService;
use App\Domain\Service\UserService;
use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Anuncio extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anuncio';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'advertise';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'id_pessoa', 'id_pessoa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'id_veiculo', 'id_veiculo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fotos()
    {
        return $this->hasMany(AnuncioFoto::class, 'id_anuncio', 'id_anuncio');
    }

    public function title()
    {
        return implode(' ', [
            $this->veiculo->categoria->montadora->nome,
            $this->veiculo->nome,
            $this->ano_modelo,
        ]);
    }

    /**
     * Import Fotos
     * @param Advertisement $advertisement
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    public function convertPictures(Advertisement $advertisement)
    {
        $filename = storage_path('app/import.jpg');

        foreach ($this->fotos as $foto) {
            copy("http://classificars.com.br/thumb.php?f={$foto->foto}", $filename);
            $file = new UploadedFile($filename, $filename);

            app(PictureService::class)->create($advertisement, $file);
        }
    }
}
