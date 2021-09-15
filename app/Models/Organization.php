<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Organization extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'origanizations';
    protected $fillable=['name_club','owner_club','desc','team_name','cabang_id'];
}
