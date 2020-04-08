<?php

namespace Kouloughli\Http\Controllers\Web;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Kouloughli\Helpers\Helper;
use Kouloughli\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kouloughli\Repositories\File\FileRepository;
use Kouloughli\Support\Enum\FileImportance;
use Auth;

class DashboardController extends Controller
{
    private $file;
    private $currentClientIp;
    private $edit;


    public function __construct(Request $request,FileRepository $file)
    {
        $this->edit = false;
        $this->file = $file;
        $this->currentClientIp = $request->ip();
    }

    /**
     * Displays the application dashboard.
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if (session()->has('verified')) {
            session()->flash('success', __('E-Mail verified successfully.'));
        }

        $orderBy = $request->orderBy ?: 'id';

        if($orderBy == 'last-updated'){
            $orderBy = 'updated_at';
        }elseif($orderBy == 'recent'){
            $orderBy = 'created_at';
        }
        $order   = $request->order ?: 'desc';

        $documents = !auth()->user()->hasRole('Admin') ? $this->file->paginateForDirection(
            20,
            $request->search,
            $request->importance,
            $request->filter_date_arrivee,
            $orderBy,
            $order
        ) : null;

        $view =  view('file-manager.index',[
            'documents' => $documents,
            'space' => Helper::diskSpace(),
            'latests' => !auth()->user()->hasRole('Admin') ? $this->file->latestForDirection(4) : null,
            'importances' => FileImportance::lists(),
            'pageNumbers' => FileImportance::pageNumbers(),
            'currentClientIp' => $this->currentClientIp,
            'edit' => $this->edit
        ]);
        if(auth()->user()->hasRole('Admin')){
            $view = view('dashboard.index');
        }

        return $view;
    }
}
