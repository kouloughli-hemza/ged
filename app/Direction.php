<?php

namespace Kouloughli;

use Illuminate\Database\Eloquent\Model;
use Kouloughli\Presenters\DirectionPresenter;
use Kouloughli\Presenters\Traits\Presentable;

class Direction extends Model
{
    use  Presentable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'directions';
    protected $primaryKey = 'id_direc';
    protected $presenter = DirectionPresenter::class;




    protected $fillable = ['direc_name', 'direc_description','direc_email',
        'direc_phone','direc_status','folder_path'];


    /**
     * Get All Users of direction
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'id_direc','id_direc');
    }


    /**
     * Get Ids of users in direction
     * @return mixed
     */
    public function getUserIdsAttribute()
    {
        return $this->users->pluck('ref_user');
    }


    /**
     * Get All Files For Directions
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function files()
    {
        return $this->hasManyThrough(File::class,User::class,'id_direc'
            , 'ref_user','id_direc','ref_user');
    }
}
