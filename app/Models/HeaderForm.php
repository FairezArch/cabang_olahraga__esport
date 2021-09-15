<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderForm extends Model
{
    use HasFactory;
    protected $table='headerforms';
    protected $fillable=['branch_id','header_title','question_n_answer'];
}
