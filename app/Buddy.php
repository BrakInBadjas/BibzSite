<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buddy extends Model
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function buddy() {
        return $this->belongsTo(User::class, 'buddy_id');
    }
}
