<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ServiceDocuments extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "service_documents"; //table name
	
	protected $fillable = [
	    'id',
        'service_id',
        'document_types_id',
        'status',
        
        
    ];
	
}