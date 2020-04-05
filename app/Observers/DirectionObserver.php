<?php

namespace Kouloughli\Observers;

use Illuminate\Support\Facades\Storage;
use Kouloughli\Direction;
use Kouloughli\Support\Enum\DirectionStatus;
use Kouloughli\Support\Enum\UserStatus;

class DirectionObserver
{

    /**
     * Handle the direction "creating" event.
     *
     * @param  \Kouloughli\Direction  $direction
     * @return void
     */
    public function creating(Direction $direction)
    {
        // Create Directory for the direction
        $directory = $direction->folder_path;
        Storage::disk('ged')->makeDirectory($directory);
    }

    /**
     * Handle the direction "created" event.
     *
     * @param  \Kouloughli\Direction  $direction
     * @return void
     */
    public function created(Direction $direction)
    {
        //
    }

    /**
     * Handle the direction "updated" event.
     *
     * @param  \Kouloughli\Direction  $direction
     * @return void
     */
    public function updated(Direction $direction)
    {
        // When a direction is updated we disable all its users accounts and vice versa
        if($direction->direc_status == DirectionStatus::NONACTIVE){
            $direction->users()->where('status',UserStatus::ACTIVE)->update(['status' => UserStatus::UNCONFIRMED]);
        }elseif($direction->direc_status == DirectionStatus::ACTIVE){
            $direction->users()->where('status',UserStatus::UNCONFIRMED)->update(['status' => UserStatus::ACTIVE]);
        }
    }

    /**
     * Handle the direction "deleted" event.
     *
     * @param  \Kouloughli\Direction  $direction
     * @return void
     */
    public function deleted(Direction $direction)
    {
        Storage::disk('ged')->deleteDirectory($direction->folder_path);
    }

    /**
     * Handle the direction "restored" event.
     *
     * @param  \Kouloughli\Direction  $direction
     * @return void
     */
    public function restored(Direction $direction)
    {
        Storage::disk('ged')->makeDirectory($direction->folder_path);
    }

    /**
     * Handle the direction "force deleted" event.
     *
     * @param  \Kouloughli\Direction  $direction
     * @return void
     */
    public function forceDeleted(Direction $direction)
    {
        Storage::disk('ged')->deleteDirectory($direction->folder_path);

    }
}
