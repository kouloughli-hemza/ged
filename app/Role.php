<?php

namespace Kouloughli;

use Illuminate\Database\Eloquent\Model;
use Kouloughli\Support\Authorization\AuthorizationRoleTrait;

class Role extends Model
{
    use AuthorizationRoleTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';
    protected $primaryKey = 'ref_role';


    protected $casts = [
        'removable' => 'boolean'
    ];

    protected $fillable = ['role_name', 'role_display', 'role_description'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    
}
