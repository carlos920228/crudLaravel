<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
	use SoftDeletes;
	const HOMBRE='H';
	const MUJER='M';
	public $transformer = UserTransformer::class;

    protected $table = 'students';
    protected $dates = ['deleted_at'];
    protected $fillable=[
    	'name',
    	'address',
    	'telephone',
    	'sex',
    	'age',
    	'grade',
    	'tutor_name',
    	'telephone_tutor',
    	'email'
    ];
    //pasamos a min el nombre
    public function setNameAttribute($valor)
    {
        $this->attributes['name'] = strtolower($valor);
    }
    public function setTutorNameAttribute($valor)
    {
        $this->attributes['tutor_name'] = strtolower($valor);
    }
    //lo retornamos en formato cada palabra en mayúsculas
    public function getNameAttribute($valor)
    {
        return ucwords($valor);
    }
    public function getTutorNameAttribute($valor)
    {
        return ucwords($valor);
    }
}
