<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'director';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','date_of_birth', 'gender'];

    public function movie()
	{
		return $this->hasMany(\App\Model\Movie::class, 'id_director');
	}
}
