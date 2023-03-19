<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserDocument extends Model
{ 
	use HasFactory;
	use SoftDeletes;
	protected $table = "user_documents"; //table name
	
	protected $fillable = [
	    'id',
	    'aadhar_no',
	    'pan_no',
	    'fathers_name',
	    'cin',
	    'company_name',
	    'incorporation_date',
	    'gender',
	    'dob',
	    'house_no',
	    'area',
	    'city',
	    'state',
	    'code',
	    'ifsc',
	    'bank_name',
	    'bank_account_no',
	    'pincode',
	    'aadhar_image',
	    'pan_image',
	    'role_id',
	    'cpo_certificate',
	    'membership_certificate',
	    'user_id',
    ];
    
  
}