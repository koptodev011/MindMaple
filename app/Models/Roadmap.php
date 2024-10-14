<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    use HasFactory;
    protected $fillable = [ 'subject_id', 'start_date', 'end_date'];
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
