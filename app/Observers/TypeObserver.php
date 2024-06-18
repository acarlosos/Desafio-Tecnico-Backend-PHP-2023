<?php

namespace App\Observers;

use App\Models\Type;

class TypeObserver
{
    /**
     * Handle the Type "creating" event.
     *
     * @param  \App\Models\Type  $type
     * @return void
     */
    public function creating(Type $type)
    {
        $type->slug = \Str::slug($type->name);
    }

    /**
     * Handle the Type "updated" event.
     *
     * @param  \App\Models\Type  $type
     * @return void
     */
    public function updating(Type $type)
    {
        $type->slug = \Str::slug($type->name);
    }

    /**
     * Handle the Type "deleted" event.
     *
     * @param  \App\Models\Type  $type
     * @return void
     */
    public function deleted(Type $type)
    {
        //
    }

    /**
     * Handle the Type "restored" event.
     *
     * @param  \App\Models\Type  $type
     * @return void
     */
    public function restored(Type $type)
    {
        //
    }

    /**
     * Handle the Type "force deleted" event.
     *
     * @param  \App\Models\Type  $type
     * @return void
     */
    public function forceDeleted(Type $type)
    {
        //
    }
}
