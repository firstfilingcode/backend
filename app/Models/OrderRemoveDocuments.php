<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrderRemoveDocuments extends Model
{
	use HasFactory;
	protected $table = "order_remove_documents"; //table name
	
	protected $fillable = [
	    'id',
        'branch_id',
        'order_id',
        'user_id',
        'files',
        'status',

        
    ];
	
}