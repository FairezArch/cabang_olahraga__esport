<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class participationevent extends Model
{
    use HasFactory;
    protected $table = 'participationevent';
    protected $fillable=['event_id','club_id','team_id'];
}
