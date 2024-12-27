<?php

namespace App\Observers;

use App\Models\Jet;
use Illuminate\Support\Facades\Log;

class JetObserver
{
    /**
     * Handle the Jet "created" event.
     */
    public function created(Jet $jet): void
    {
        //
        Log::info('New jet created', [
            'id' => $jet->id,
            'name' => $jet->name,
            'model' => $jet->model
        ]);
    }

    /**
     * Handle the Jet "updated" event.
     */
    public function updated(Jet $jet): void
    {
        //
        Log::info('Jet updated', [
            'id' => $jet->id,
            'changes' => $jet->getDirty()
        ]);
    }

    /**
     * Handle the Jet "deleted" event.
     */
    public function deleted(Jet $jet): void
    {
        //

        Log::info('Jet deleted', [
            'id' => $jet->id,
            'name' => $jet->name
        ]);

        // You might want to handle related reviews
        $jet->reviews()->delete();
    }

    /**
     * Handle the Jet "restored" event.
     */
    public function restored(Jet $jet): void
    {
        //
        Log::info('Jet restored', [
            'id' => $jet->id,
            'name' => $jet->name
        ]);
    }

    /**
     * Handle the Jet "force deleted" event.
     */
    public function forceDeleted(Jet $jet): void
    {
        //
        Log::info('Jet force deleted', [
            'id' => $jet->id,
            'name' => $jet->name
        ]);
    }
}
