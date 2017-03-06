<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adtje extends Model
{
    use softDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $appends = ['approved', 'approvals'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function getApprovedAttribute()
    {
        return $this->approvals >= config('bibz.adtjes_validator_count');  
    }

    public function getApprovalsAttribute()
    {
        return $this->validations()->where('status', AdtjeValidation::APPROVE)->count();  
    }

    public function scopeOpen($query)
    {
        return $query->where('collected', false);
    }

    public function scopeApproved($query, $approved = true)
    {
        return $query->whereHas('validations', function($q) use ($approved) {
                $q->where('status', AdtjeValidation::APPROVE);
        }, $approved ?'>=' : '<', config('bibz.adtjes_validator_count'));
    }

    public function validations()
    {
        return $this->hasMany(AdtjeValidation::class);
    }
}
