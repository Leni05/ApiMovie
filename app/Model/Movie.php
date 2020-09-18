<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
  /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movie';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_genre','id_director', 'title', 'description', 'year', 'duration'];

    // public function movieactor()
    // {
    //     return $this->hasMany('App\Model\MovieActor');
    // }

    public function director()
	{
		return $this->belongsTo(\App\Model\Director::class, 'id_director');
    }
    
    public function gendre()
	{
		return $this->belongsTo(\App\Model\Gendre::class, 'id_genre');
    }
    
    public function actor()
    {
        return $this->belongsToMany(\App\Model\Actor::class, 'movie_actor');
    }
}