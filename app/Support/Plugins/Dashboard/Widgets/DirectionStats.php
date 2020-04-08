<?php
/**
 * Created by PhpStorm.
 * User: kouloughli
 * Date: 3/28/20
 * Time: 4:46 PM
 */
namespace Kouloughli\Support\Plugins\Dashboard\Widgets;


use Kouloughli\Plugins\Widget;
use Kouloughli\Repositories\Direction\DirectionRepository;

class DirectionStats extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '3';

    /**
     * {@inheritdoc}
     */
    protected $permissions = 'directions.manage';

    /**
     * @var DirectionRepository
     */
    private $directions;

    /**
     * TotalDirections constructor.
     * @param DirectionRepository $users
     */
    public function __construct(DirectionRepository $directions)
    {
        $this->directions = $directions;
    }


    public function render()
    {
        $colors = ['purple','teal','pink','warning','success','primary'];
        return view('plugins.dashboard.widgets.direction-stats', [
            'directions' => $this->directions->directionsWithFileCount(),
            'colors' => $colors
        ]);
    }
}