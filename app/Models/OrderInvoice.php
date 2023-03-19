<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrderInvoice extends Model
{
	use HasFactory;
	protected $table = "order_invoices"; //table name
	
	protected $fillable = [
	    'id',
        'order_id',
        'user_id',
        'invoice_status',
        'payment_status',
    ];
	
}