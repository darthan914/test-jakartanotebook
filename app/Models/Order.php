<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function orderable()
    {
        return $this->morphTo();
    }

    public function setOrderNoAttribute($value)
    {
        $this->attributes['order_no'] = str_pad($value, 10, "0", STR_PAD_LEFT);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d F Y H:i:s', strtotime($value));
    }

    public function getDatetimePaidAttribute($value)
    {
        return date('d F Y H:i:s', strtotime($value));
    }
}
