<?php

namespace Kouloughli\Support\Plugins\Dashboard\Widgets;

use Carbon\Carbon;
use Kouloughli\File;
use Kouloughli\Plugins\Widget;
use Kouloughli\Repositories\File\FileRepository;
use Kouloughli\Repositories\User\UserRepository;

class RecentFiles extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '4';

    /**
     * {@inheritdoc}
     */
    protected $permissions = 'files.preview';

    /**
     * @var UserRepository
     */
    private $files;

    /**
     * LatestRegistrations constructor.
     * @param UserRepository $users
     */
    public function __construct(FileRepository $files)
    {
        $this->files = $files;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        return view('plugins.dashboard.widgets.recent-files', [
            'latestFiles' => $this->files->latest(10),
            'thisWeek' => $this->weekCount(),
            'thisMonth' => $this->monthCount(),
            'thisYear' => $this->yearCount()

        ]);
    }

    private function weekCount()
    {
        return File::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    }

    private function monthCount()
    {
        return File::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
    }

    private function yearCount()
    {
        return File::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();
    }
}
