<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class EmailTamplate extends Model
{
	use HasFactory;
	protected $table = "email_tamplates"; //table name
	
	protected $fillable = [
	    'id',
	     'category',
	     'title',
        'email_description',
        'status',
        
    ];
	
}