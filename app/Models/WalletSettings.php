<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WalletSettings extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "user_wallet_settings"; //table name
	
	protected $fillable = [
	    'id',
        'user_use_by',
    ];
	
}