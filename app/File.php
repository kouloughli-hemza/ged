<?php

namespace Kouloughli;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Kouloughli\Presenters\FileImportancePresenter;
use Kouloughli\Presenters\Traits\Presentable;

class File extends Model
{
    use Presentable;

    protected $presenter = FileImportancePresenter::class;

    protected $fillable = [
        'expiditeur','destinataire','objet','num_text','num_enrg','nombre_page',
        'communication_a','date_arrivee','heur_arrivee','sig_ext',
        'sig_int','file_name','file_size','file_path','mime','ref_user','importance'
    ];


    protected $dates = ['date_arrivee'];

    public function getFileSizeAttribute($value)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $value > 1024; $i++) {
            $value /= 1024;
        }

        return round($value, 2) . ' ' . $units[$i];
    }

    public function getFilePathAttribute()
    {
        $path = URL::asset('storage/ged/' . $this->user->direction->folder_path . '/' . $this->file_name);
        return $path;
    }
    /**
     * Get The User that own this File
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class,'ref_user');
    }


}
