<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Krisar extends Model
{
	protected $primaryKey = 'id_krisar';
    protected $table = 'kritik_saran';
    protected $fillable = ['id_user','krisar','rating_app'];
}
