<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Faq extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "faqs"; //table name
	
	protected $fillable = [
	    'id',
        'question',
        'answer',
        'page_name',
        'status',
      
    ];
	
}