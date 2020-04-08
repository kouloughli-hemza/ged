<?php

namespace Kouloughli\Support\Plugins\Dashboard\Widgets;

use Kouloughli\Plugins\Widget;
use Kouloughli\Repositories\File\FileRepository;
use Kouloughli\Repositories\User\UserRepository;
use Kouloughli\Charts\DocumentsByDirectionChart as chart;
class DocumentsByDirectionChart extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '4';

    /**
     * {@inheritdoc}
     */
    protected $permissions = 'directions.manage';

    /**
     * @var UserRepository
     */
    private $files;

    /**
     * @var
     */
    protected $directionsFiles;

    /**
     * @var
     */
    protected $directionChart;


    /**
     * DirectionChart constructor.
     * @param FileRepository $files
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
        $this->getDirectionsFiles();
        $data = $this->directionsFiles;
        $barChart = new chart();
        $barChart->labels(array_keys($data));
        $barChart->dataset('DOCS','bar',array_values($data));
        $this->directionChart = $barChart;

        return view('plugins.dashboard.widgets.documents-by-direction-chart', [
            'chart' => $barChart,
            //'counts' => $this->getDirectionsFiles()
        ]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|null
     */
    public function scripts()
    {
        return view('plugins.dashboard.widgets.documents-by-direction-chart-scripts', [
            'chart' => $this->directionChart,
        ]);
    }


    /**
     *
     * @return mixed
     */
    private function getDirectionsFiles()
    {
        if ($this->directionsFiles) {
            return $this->directionsFiles;
        }

        return $this->directionsFiles = $this->files->directionsFiles();

    }


}
