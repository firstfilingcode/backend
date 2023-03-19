<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Kyslik\ColumnSortable\Sortable;

class WebUser extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, Sortable;
   // protected $guard_name = 'admin-web';
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'id',
        'name',
        'mobile',
        'password',
        'status',
        'profile',
        'email',
        'userName',
        'dob',
        'role_id',
        'show_password',
        
    ];

/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public  static function  countRm(){
        $data = User::where('role_id',2)->count();
        return $data;
    }
  
}
