<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [ 'subject_name'];

    public function roadmaps()
    {
        return $this->hasMany(Roadmap::class, 'subject_id');
    }
}
