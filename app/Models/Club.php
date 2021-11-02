<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Club extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['iduser','club_name','slug','cabang_id','file','description','teams'];
}
