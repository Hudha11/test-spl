<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SplItem extends Model
{
    protected $table = 'spl_items';

    protected $fillable = [
        'spl_id',
        'user_id',
        'date',
        'start_time',
        'end_time',
        'duration_hours',
        'status',
        'notes'
    ];

    public function spl()
    {
        return $this->belongsTo(Spl::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
