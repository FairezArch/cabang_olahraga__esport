<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class GamesModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'games';
    protected $fillable = ['game_name','slug','game_description','image_game','logo_game','rules','cabang_id'];
}
