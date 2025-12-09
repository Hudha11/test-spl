<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spl extends Model
{
    protected $table = 'spls';

    protected $fillable = [
        'kode_spl',
        'created_by',
        'department_id',
        'section_id',
        'notes',
        'status',
    ];

    // Relations
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    // public function spl_items()
    // {
    //     return $this->hasMany(SplItem::class);
    // }
}
