<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Binnacle extends Model
{
    //base de datos que será asignada
    protected $table = 'binnacle';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'user_acount', 'myip', 'created_at', 'date_end', 'logs', 'log_types'
    ];

    protected $dates = [ 'created_at', 'updated_at' ];

    protected $hidden = [
    	'id'
    ];


}
