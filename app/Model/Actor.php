<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'actor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','date_of_birth', 'gender'];

    public function movie()
    {
        return $this->belongsToMany(\App\Model\Movie::class);
    }
}
