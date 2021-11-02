<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestMembers extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'request_members';
    protected $fillable = ['user_id','club_id','approve','description'];
}
