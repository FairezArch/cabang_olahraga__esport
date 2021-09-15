<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AwardsModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'awards';
    protected $fillable = ['award_name','slug','award_logo','description'];
}
