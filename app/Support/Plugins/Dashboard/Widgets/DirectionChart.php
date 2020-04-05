<?php

namespace Kouloughli\Support\Plugins\Dashboard\Widgets;

use Carbon\Carbon;
use Kouloughli\File;
use Kouloughli\Plugins\Widget;
use Kouloughli\Repositories\File\FileRepository;
use Kouloughli\Repositories\User\UserRepository;

class DirectionChart extends Widget
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
        return view('plugins.dashboard.widgets.directions-chart', [
            'counts' => $this->getDirectionsFiles()
        ]);
    }

    public function scripts()
    {
        return view('plugins.dashboard.widgets.directions-charts-scripts', [
            'counts' => $this->getDirectionsFiles()
        ]);
    }

    private function getDirectionsFiles()
    {
        if ($this->directionsFiles) {
            return $this->directionsFiles;
        }

        return $this->directionsFiles = $this->files->directionsFiles();

    }


}
