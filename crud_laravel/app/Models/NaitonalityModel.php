<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class NaitonalityModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'nationality_id';
    public $timestamps = false;
    protected $table = 'nationalities';
    protected $guarded = [];
}
