<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Expense extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "expenses"; //table name
	
	protected $fillable = [
	    'id',
        'expense_name',
        'quantity',
        'rate',
        'date',
        'amount',
        'attachment',
        'description',
        'total_amt',
        'status',
      
    ];
	
}