<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrderRequiredDocuments extends Model
{
	use HasFactory;
	protected $table = "order_required_documents"; //table name
	
	protected $fillable = [
	    'id',
        'branch_id',
        'order_id',
        'user_id',
        'documents',
        'files',
        'files_name',
        'password',
        'status',
        'document_type_id',
        
        
    ];
	
}