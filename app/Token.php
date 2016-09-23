<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_usuario', 'token',
    ];

    protected $dates = [ 'created_at', 'updated_at'];
    /**
     * The attributes that are mass asssignable.
     * @var array 
     */
    protected $hidden = [
    	'id'
    ];
}
