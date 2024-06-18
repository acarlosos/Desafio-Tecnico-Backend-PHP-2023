<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory, SoftDeletes, BelongsToUser;
    protected $fillable = [
        'name',
        'slug',
        'user_id',
    ];

    protected $hidden = [
        'slug',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
