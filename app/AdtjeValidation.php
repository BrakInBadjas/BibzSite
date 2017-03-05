<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdtjeValidation extends Model
{
    use softDeletes;

    public function adtje()
    {
        return $this->belongsTo(Adtje::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class);
    }
}
