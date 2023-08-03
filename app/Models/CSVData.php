<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSVData extends Model
{
    protected $table = 'csv_data'; 
    // use HasFactory;
    protected $fillable = ['date', 'time', 'users', 'value'];
}
