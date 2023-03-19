<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
	protected $table = 'settings';
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'logo', 'email','phone','about_us','privacy_policy','terms_and_conditions','refer_earn','name', 'pincode','address','tin_no','service','contact_us','linkedin_link','watsapp_link','facebook_link','youtube_link','twitter_link','instagram_link'
    ];
}
