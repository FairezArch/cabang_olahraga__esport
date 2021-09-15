<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class EventsModel extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='events';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable=['event_name','slug','file','description','start_date','end_date','cabang_id'];
}
