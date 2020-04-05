<?php
/**
 * Created by PhpStorm.
 * User: kouloughli
 * Date: 3/28/20
 * Time: 4:26 PM
 */
namespace Kouloughli\Support\Plugins\Dashboard\Widgets;


use Kouloughli\Plugins\Widget;
use Kouloughli\Repositories\Direction\DirectionRepository;

class TotalDirections extends Widget
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
        return view('plugins.dashboard.widgets.total-directions', [
            'count' => $this->directions->count(),
            'countUnConfirmed' => $this->directions->countUnconfirmed()
        ]);
    }
}