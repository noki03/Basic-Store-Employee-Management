<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'employee_id'; // Primary key
    protected $fillable = [
        'employee_name',
        'employee_position',
        'employee_Email',
        'employee_ContactNumber',
        'store_id',
        'store_name',
    ];

    // Define the relationship with Store
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }
}
