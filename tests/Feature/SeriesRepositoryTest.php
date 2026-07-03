<?php

namespace Tests\Feature;

use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeriesRepositoryTest extends TestCase {
    use RefreshDatabase;
    public function test_when_a_series_is_created_its_seasons_and_episodes_must_also_be_created(): void{
        // prepara cenário
        // criando instancia já configurada
        $repository = $this->app->make(SeriesRepository::class);
        $request = new SeriesFormRequest();
        $request->name = "Nome da série";
        $request->seasonsQty = 1;
        $request->episodesPerSeason = 1;
        
        // executa o teste
        $repository->add($request, null);

        // verifica oq executou
        //verificar que a base de dados tem o nome da serie
        $this->assertDatabaseHas('series', ['name'=>'Nome da série']);
        $this->assertDatabaseHas('seasons', ['number'=> 1]);
        $this->assertDatabaseHas('episodes', ['number'=> 1]);
    }
}
