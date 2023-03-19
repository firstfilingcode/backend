<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ServicesType extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "service_types"; //table name
	
	protected $fillable = [
	    'id',
        'name',
        'status_id',
        'status',
        'cin',
        'company',
        'cin_date',
        'first_name',
        'last_name',
        'father_name',
        'gander',
        'date_of_birth',
        'pan_number',
        'aadhar_number',
        'area',
        'pin_code',
        'state',
        'city',
        'email',
        'code',
        'mobile_number',
        'Ifsc',
        'bank_name',
        'bank_account_no',
        
        
    ];
	
}