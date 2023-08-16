<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'name',
        'checklist_id'
    ];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class, 'checklist_id', 'id');
    }
}
