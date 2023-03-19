<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrderReimbursement extends Model
{
	use HasFactory;
	protected $table = "order_reimbursements"; //table name
	
	protected $fillable = [
	    'id',
        'order_id',
        'user_id',
        'amount',
        'files',
        'invoice_number'
    ];
	
}