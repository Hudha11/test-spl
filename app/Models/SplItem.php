<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SplItem extends Model
{
    protected $table = 'spl_items';

    protected $fillable = [
        'spl_id',
        'date',
        'start_time',
        'end_time',
        'duration_hours',
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
