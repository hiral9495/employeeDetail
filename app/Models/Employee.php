<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_code',
        'first_name', 
        'last_name', 
        'joining_date', 
        'profile_image'
    ];

    public static function generateEmployeeCode()
    {
        $lastEmployee = self::orderBy('id', 'desc')->first();
        $lastCode = $lastEmployee ? $lastEmployee->employee_code : 'EMP-0000';

        $lastNumber = intval(substr($lastCode, 4));

        $newNumber = $lastNumber + 1;
        $newCode = 'EMP-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        return $newCode;
    }
}
