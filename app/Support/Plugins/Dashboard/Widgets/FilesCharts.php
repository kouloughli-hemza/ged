<?php

namespace Kouloughli\Support\Plugins\Dashboard\Widgets;

use Carbon\Carbon;
use Kouloughli\File;
use Kouloughli\Plugins\Widget;
use Kouloughli\Repositories\File\FileRepository;
use Kouloughli\Repositories\User\UserRepository;

class FilesCharts extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '4';

    /**
     * {@inheritdoc}
     */
    protected $permissions = 'users.manage';

    /**
     * @var UserRepository
     */
    private $files;

    protected $filePerMonth;

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
        return view('plugins.dashboard.widgets.files-chart', [
            'lastestFiles' => $this->files->latest(6),
            'counts' => $this->getFilesPerMonth()
        ]);
    }

    public function scripts()
    {
        return view('plugins.dashboard.widgets.files-charts-scripts', [
            'counts' => $this->getFilesPerMonth()
        ]);
    }

    private function getFilesPerMonth()
    {
        if ($this->filePerMonth) {
            return $this->filePerMonth;
        }

        $this->filePerMonth = $this->files->filesPerMonth(
            Carbon::now()->subYear()->startOfMonth(),
            Carbon::now()->endOfMonth()
        );

    }


}
