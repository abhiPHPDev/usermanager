<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userroles extends Model
{
    use HasFactory;
    
    protected $table="user_roles";
    protected $primaryKey = "id"; 
    public $incrementing = true;

    protected $fillable = ['role'];
}
