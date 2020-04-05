<?php
/**
 * Created by PhpStorm.
 * User: kouloughli
 * Date: 3/28/20
 * Time: 4:26 PM
 */

namespace Kouloughli\Support\Plugins\Dashboard\Widgets;

use Kouloughli\Plugins\Widget;
use Kouloughli\Repositories\File\FileRepository;

class TotalDocuments extends Widget
{

    /**
     * {@inheritdoc}
     */
    public $width = '3';

    /**
     * {@inheritdoc}
     */
    protected $permissions = 'files.preview';

    /**
     * @var FileRepository
     */
    private $files;


    /**
     * TotalDocuments constructor.
     * @param FileRepository $files
     */
    public function __construct(FileRepository $files)
    {
        $this->files = $files;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function render()
    {
        return view('plugins.dashboard.widgets.total-documents', [
            'count' => $this->files->count()
        ]);
    }
}