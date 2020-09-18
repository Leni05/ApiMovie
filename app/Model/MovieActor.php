<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MovieActor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movie_actor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_movie','id_actor'];

    // public function movie()
    // {
    //     return $this->belongsTo(\App\Model\Movie::class, 'id_movie');
    // }

    // public function actor()
    // {
    //     return $this->belongsTo(\App\Model\Actor::class, 'id_actor');
    // }
}
