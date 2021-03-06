<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdtjeValidation extends Model
{
    /**
     * The string used to define an approved validation.
     */
    const APPROVE = 'approved';

    /**
     * The string used to define an undecided validation.
     */
    const NULL = 'null';

    /**
     * The string used to define a denied validation.
     */
    const DENY = 'denied';

    use softDeletes;
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function adtje()
    {
        return $this->belongsTo(Adtje::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approved()
    {
        return $this->status == APPROVE;
    }

    public function denied()
    {
        return $this->status == DENY;
    }
}
