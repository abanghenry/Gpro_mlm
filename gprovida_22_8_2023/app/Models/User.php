<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const ACTIVE_USER =1;
    const INACTIVE_USER =0;

    const WELCOMED_USER =1;
    const UNWELCOMED_USER =0;


    const ADMIN_USER = '5';
    const STORE_MANAGER = '3';
    const REGULAR_USER ='1';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'gender',
        'email',
        'password',
        'profession',
        'skills',

        'phone',
        'address',
        'address2',
        'city',
        'state',
        'country',

        'referred_by',
        'parent',
        'position',
        'package_id',
        'type',

        'payment_method',
        'currency_id',
        'active',
        'registration_pin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $appends = ['encrypted_id','joined_date'];

    public function getJoinedDateAttribute()
    {
        return $this->created_at?->format('M j, Y');
    }
    public function getEncryptedIdAttribute()
    {
        return  Crypt::encryptString($this->id);
    }
    public function getTextAttribute()
    {
        return ucwords(str_replace("_"," ", $this->key));
    }



    public function isAdmin(){
        if($this->type==5){
            return TRUE;
        }else{
            return FALSE;
        }
    }


    public function isActivated(){
        if($this->active==1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function isWelcomed(){
        if($this->welcomed==1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function isWelcomedUpgrade(){
        if($this->upgrade_welcomed==1){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function canImpersonate()
    {
        return $this->isAdmin();
    }

    public function canBeImpersonated()
    {
        return !$this->isAdmin();
    }


    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
    public function bank(){
        return $this->hasMany(Bank::class,'user_id')->where('default','=', 1);
    }

    public function store(){
       // return $this->hasMany(Store::class);
    }

    public function upline()
    {
        return $this->belongsTo(User::class, 'parent', 'id');
    }
    public function downlines()
    {
        return $this->hasMany(User::class, 'parent', 'id')->orderBy('position');
    }
    public function downlinesWith30PV()
    {
        //return $this->downlines()->where('current_binary_pv','>=', 30);
        //return $this->downlines()->where('current_binary_pv' + 'spill_over_binary_pv','>=', 30);

        return $this->downlines()->where(DB::raw('current_binary_pv + spill_over_binary_pv'),'>=', 30);

    }
    public function referred()
    {
        return $this->hasMany(User::class, 'referred_by', 'id');
    }



    public function referredIds()
    {
        return $this->hasMany(User::class, 'referred_by', 'id')
                ->select(['id','username', 'referred_by','current_binary_pv']);
                //->where('referred_by','!=',$this->currentUserId);//$this->id $this->id
    }



    public function referredThisMonth()
    {
        return $this->hasMany(User::class, 'referred_by', 'id')->whereMonth('created_at', date('m')-0);
    }
    public function referredLastMonth()
    {
        $last_month = date('m')-1;
        if($last_month==0){
            $last_month = 12; // last year december
        }
        return $this->hasMany(User::class, 'referred_by', 'id')->whereMonth('created_at',$last_month);
    }


    public function session(){
        return $this->hasOne(Session::class)->latestOfMany();  //  latest ->latestOfMany();
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }









    /*
    $table->double('current_binary_pv', 8,2)->after('deleted_at')->nullable();
    $table->double('spill_over_binary_pv', 8,2)->after('current_binary_pv')->nullable();
    $table->double('cumulative_binary_pv', 12,2)->after('spill_over_binary_pv')->nullable();

    $table->double('current_direct_pv', 8,2)->after('last_cycle_binary')->nullable();
    $table->double('spill_over_direct_pv', 8,2)->after('current_direct_pv')->nullable();
    $table->double('cumulative_direct_pv', 12,2)->after('spill_over_direct_pv')->nullable();
    */


}
