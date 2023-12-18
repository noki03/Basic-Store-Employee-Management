<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';
    protected $primaryKey = 'store_id'; // Primary key
    protected $fillable = [
        'store_name',
        'store_location',
        'store_Email',
        'store_ContactNumber',
    ];

    // Define the relationship with Employee
    public function employees()
    {
        return $this->hasMany(Employee::class, 'store_id', 'store_id');
    }
}
