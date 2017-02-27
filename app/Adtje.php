<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adtje extends Model
{
    use softDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'added_by');
    }
}