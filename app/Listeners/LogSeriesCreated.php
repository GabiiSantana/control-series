<?php

namespace App\Listeners;

use App\Events\SeriesCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

// Quando um evento que gera a execução disso for emitido, uma tarefa vai ser criada pra executar o listener depois 
class LogSeriesCreated implements ShouldQueue { 
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SeriesCreated $event): void {
        Log::info("Série {$event->seriesName} criada com sucesso!");
    }
}
