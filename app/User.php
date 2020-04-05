<?php

namespace Kouloughli;

use Mail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Kouloughli\Events\User\RequestedPasswordResetEmail;
use Kouloughli\Presenters\Traits\Presentable;
use Kouloughli\Presenters\UserPresenter;
use Kouloughli\Services\Auth\Api\TokenFactory;
use Kouloughli\Services\Auth\TwoFactor\Authenticatable as TwoFactorAuthenticatable;
use Kouloughli\Services\Auth\TwoFactor\Contracts\Authenticatable as TwoFactorAuthenticatableContract;
use Kouloughli\Support\Authorization\AuthorizationUserTrait;
use Kouloughli\Support\CanImpersonateUsers;
use Kouloughli\Support\Enum\UserStatus;

class User extends Authenticatable implements TwoFactorAuthenticatableContract, JWTSubject, MustVerifyEmail
{
    use TwoFactorAuthenticatable,
        CanResetPassword,
        Presentable,
        AuthorizationUserTrait,
        Notifiable,
        CanImpersonateUsers;

    protected $presenter = UserPresenter::class;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $primaryKey = 'ref_user';


    protected $dates = ['last_login', 'birthday'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'username', 'first_name', 'last_name', 'avatar',
        'last_login', 'confirmation_token', 'status',
        'remember_token', 'role_id','id_direc', 'email_verified_at'
    ];
    protected $maps = [
        'ref_user' => 'id',
    ];
    protected $append = ['id'];


    public function getIdAttribute()
    {
        return $this->attributes['ref_user'];
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class,'id_direc','id_direc');
    }

    public function gravatar()
    {
        $hash = hash('md5', strtolower(trim($this->attributes['email'])));

        return sprintf("https://www.gravatar.com/avatar/%s?size=150", $hash);
    }

    public function isUnconfirmed()
    {
        return $this->status == UserStatus::UNCONFIRMED;
    }

    public function isActive()
    {
        return $this->status == UserStatus::ACTIVE;
    }

    public function isBanned()
    {
        return $this->status == UserStatus::BANNED;
    }



    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->ref_user;
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return ['jti' => app(TokenFactory::class)->forUser($this)->ref_user];
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        Mail::to($this)->send(new \Kouloughli\Mail\ResetPassword($token));

        event(new RequestedPasswordResetEmail($this));
    }
}
