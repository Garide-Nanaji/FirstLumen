<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    //protected $table = "employees";
    //public $timestamps = false;
    protected $fillable = [
         'Emp_name',
         'Emp_email',
         'Emp_no',
         'Emp_phone'
        
    ];
}
