<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrderDocumentSendToClient extends Model
{
	use HasFactory;
	protected $table = "order_document_send_to_clients"; //table name
	
	protected $fillable = [
	    'id',
        'branch_id',
        'order_id',
        'user_id',
        'files',
        'status',
        'date',
        
    ];
	
}