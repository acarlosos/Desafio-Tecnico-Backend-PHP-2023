<?php
namespace App\Traits;
use App\Models\User;
use App\Scope\UserScope;

trait BelongsToUser
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function bootBelongsToUser()
    {
        static::addGlobalScope(new UserScope);

        static::creating(function($model){
            if(auth()->user()  ){
                $model->user_id = auth()->user()->id;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}