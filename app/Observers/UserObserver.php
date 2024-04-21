<?php

namespace App\Observers;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Log::info("SALVANDO NA AUDITORIA");
        try {
            $audit = new Audit();
            $audit->event = 'created';
            $audit->user_id = auth()->id();
            $audit->when = now();
            $audit->ip = request()->ip();
            $audit->auditable_id = $user->id;
            $audit->auditable_type = User::class;
            $audit->details = $user->toArray();


            $audit->save();
        }catch (\Exception $exception){
            Log::info("ERRO AUDITORIA");
        }

    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        Log::info("SALVANDO NA AUDITORIA");
        $old = [];
        foreach ($user->getDirty() as $dirtyKey => $dirtyValue){
            $old[$dirtyKey] = $user->getOriginal($dirtyKey);
        }

        try {
            $audit = new Audit();
            $audit->event = 'updated';
            $audit->user_id = auth()->id();
            $audit->when = now();
            $audit->ip = request()->ip();
            $audit->auditable_id = $user->id;
            $audit->auditable_type = User::class;
            $audit->details = [
                'old' => $old,
                'new' => $user->getDirty(),
            ];


            $audit->save();
        }catch (\Exception $exception){
            Log::info("ERRO AUDITORIA");
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        Log::info("SALVANDO NA AUDITORIA");
        try {
            $audit = new Audit();
            $audit->event = 'deleted';
            $audit->user_id = auth()->id();
            $audit->when = now();
            $audit->ip = request()->ip();
            $audit->auditable_id = $user->id;
            $audit->auditable_type = User::class;
            $audit->details = $user->toArray();

            $audit->save();
        }catch (\Exception $exception){
            Log::info("ERRO AUDITORIA");
        }
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
