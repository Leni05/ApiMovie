<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gendre extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gendre';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description'];

    public function movie()
	{
		return $this->hasMany(\App\Model\Movie::class, 'id_gendre');
	}
}
