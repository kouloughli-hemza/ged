<?php

namespace Kouloughli\Support\Plugins\Dashboard\Widgets;

use Carbon\Carbon;
use Kouloughli\File;
use Kouloughli\Plugins\Widget;
use Kouloughli\Repositories\File\FileRepository;
use Kouloughli\Repositories\User\UserRepository;

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
        return view('plugins.dashboard.widgets.documents-by-direction-chart', [
            'directionsFiles' => $this->getDirectionsFiles(),
            'counts' => $this->getDirectionsFiles()
        ]);
    }

    public function scripts()
    {
        return view('plugins.dashboard.widgets.documents-by-direction-chart-scripts', [
            'counts' => $this->getDirectionsFiles(),
            'yDataSet' => $this->flotChartGenerateDataSet($this->getDirectionsFiles()),
            'xDataSet' => $this->flotChartGenerateXDataSet($this->getDirectionsFiles())
        ]);
    }

    private function flotChartGenerateDataSet($elements)
    {
        $dataset = [];
        $i = 0;
        foreach ($elements as $element){
            $dataset[] = array($i,$element);
            $i++;
        }
        return $dataset;
    }

    private function flotChartGenerateXDataSet($elements)
    {
        $dataset = [];
        $i = 0;
        foreach ($elements as $key => $element){
            $dataset[] = array($i,$key);
            $i++;
        }
        return $dataset;
    }


    private function getDirectionsFiles()
    {
        if ($this->directionsFiles) {
            return $this->directionsFiles;
        }

        return $this->directionsFiles = $this->files->directionsFiles();

    }


}
