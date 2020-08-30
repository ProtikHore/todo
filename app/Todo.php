<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $guarded = [];
    protected $table = 'todos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
