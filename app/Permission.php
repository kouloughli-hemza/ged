<?php

namespace Kouloughli;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'ref_perm';
    protected $fillable = ['perm_name', 'perm_display', 'perm_description'];

    protected $casts = [
        'removable' => 'boolean'
    ];


}
