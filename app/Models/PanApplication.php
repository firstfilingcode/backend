<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class PanApplication extends Model
{
	use HasFactory;
	protected $table = "pan_application_request"; //table name
	
	protected $fillable = [
	    'title',
        'first_name',
        'last_name',
        'middle_name',
        'dob',
        'category',
        'application_type',
        'mobile',
        'email',
    ];
	
}