<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expence extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'area_of_expence', 'amount', 'month'];
}
