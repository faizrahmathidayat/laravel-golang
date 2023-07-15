<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CustomerModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'cst_id';
    public $timestamps = false;
    protected $table = 'customers';
    protected $guarded = [];

    public function nationality()
    {
        return $this->hasOne(NaitonalityModel::class, 'nationality_id','nationality_id');
    }

    public function family_list()
    {
        return $this->hasMany(FamilyListModel::class, 'cst_id','cst_id');
    }
}
