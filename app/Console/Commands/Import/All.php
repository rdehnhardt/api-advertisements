<?php

namespace App\Console\Commands\Import;

use App\Console\Commands\Import\Models\Anuncio;
use App\Console\Commands\Import\Models\AnuncioFoto;
use App\Console\Commands\Import\Models\Pessoa;
use App\Domain\Service\AdvertisementService;
use App\Domain\Service\PictureService;
use App\Domain\Service\UserService;
use App\Models\Advertisement;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class All extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users';

    /**
     * URL for image
     *
     * @var string
     */
    protected $url = 'http://classificars.com.br/thumb.php?f=%s';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    public function handle()
    {
        $this->importUsers(Pessoa::all());
    }

    /**
     * @param Collection $pessoas
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    public function importUsers(Collection $pessoas)
    {
        $pessoas->each(function ($pessoa) {
            if ($user = $this->createUser($pessoa)) {
                $this->info($user->name);
                $this->importAdvertisements($user, $pessoa->anuncios);
            }
        });
    }

    /**
     * @param User $user
     * @param Collection $anuncios
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    private function importAdvertisements(User $user, Collection $anuncios)
    {
        $anuncios->each(function ($anuncio) use ($user) {
            if ($advertisement = $this->createAdvertisement($user, $anuncio)) {
                app(AdvertisementService::class)->togglePublished($user, $advertisement->uuid);

                $this->info("---- {$advertisement->title}");
                $this->importPictures($advertisement, $anuncio->fotos);
            }
        });
    }

    /**
     * @param Advertisement $advertisement
     * @param Collection $fotos
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    private function importPictures(Advertisement $advertisement, Collection $fotos)
    {
        $fotos->each(function ($foto) use ($advertisement) {
            if ($picture = $this->createPicture($advertisement, $foto)) {
                $this->info("-------- {$picture->file}");
            }
        });
    }

    /**
     * @param $pessoa
     * @return User
     */
    private function createUser(Pessoa $pessoa)
    {
        return app(UserService::class)->create([
            'name' => ucwords(strtolower($pessoa->nome)),
            'email' => strtolower($pessoa->email),
            'password' => $pessoa->url,
        ]);
    }

    /**
     * @param User $user
     * @param Anuncio $anuncio
     * @return Advertisement
     */
    private function createAdvertisement(User $user, Anuncio $anuncio)
    {
        return app(AdvertisementService::class)->create($user, [
            'title' => ucwords(strtolower($anuncio->title())),
            'description' => $anuncio->observacao,
            'price' => $anuncio->valor,
            'tags' => str_replace(' ', ',', strtolower($anuncio->resumo)),
        ]);
    }

    /**
     * @param Advertisement $advertisement
     * @param AnuncioFoto $imagem
     * @return Picture|bool
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    private function createPicture(Advertisement $advertisement, AnuncioFoto $imagem)
    {
        return app(PictureService::class)->createFromUrl($advertisement, sprintf($this->url, $imagem->foto));
    }
}
