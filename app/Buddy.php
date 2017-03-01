<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Buddy extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function buddy() {
        return $this->belongsTo(User::class, 'buddy_id');
    }

    public function broken(){
        return $this->deleted_at != null;
    }
}
