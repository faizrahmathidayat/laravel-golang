<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class FamilyListModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'fl_id';
    public $timestamps = false;
    protected $table = 'family_lists';
    protected $guarded = [];

    public function customer()
    {
        return $this->hasOne(CustomerModel::class, 'cst_id','cst_id');
    }
}
