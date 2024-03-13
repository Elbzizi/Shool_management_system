<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matier extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function emploi()
	{
		return $this->hasMany(Emploi_temp::class);
	}

	public function exam()
	{
		return $this->hasMany('Examen\Examen');
	}

	
}
