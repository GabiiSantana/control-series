<?php

namespace App\Listeners;

use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateSerie {
    /**
     * Create the event listener.
     */
    public function __construct(private SeriesRepository $repository)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SeriesFormRequest $request): void {
        $this->repository->add($request);
    }
}
