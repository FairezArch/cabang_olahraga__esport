<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class EventOrganizations extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='event_organizations';
    protected $fillable = ['idorganization','event_name','slug','file','desc','start_date','end_date'];
}
