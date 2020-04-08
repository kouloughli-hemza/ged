<?php

namespace Kouloughli\Support\Plugins\Dashboard\Widgets;

use Carbon\Carbon;
use Kouloughli\Charts\DocumentsChart;
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

    protected $chart;

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
        $this->getFilesPerMonth();
        $data = $this->filePerMonth;
        $chart = new DocumentsChart();
        $chart->labels(array_keys($data));
        $chart->dataset(trans('Documents'),'line',array_values($data));
        $this->chart = $chart;
        return view('plugins.dashboard.widgets.documents-chart', [
            'chart' => $chart
        ]);
    }

    public function scripts()
    {

        return view('plugins.dashboard.widgets.documents-chart-script', [
            'chart' => $this->chart
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
