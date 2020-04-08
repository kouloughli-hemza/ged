<?php
/**
 * Created by PhpStorm.
 * User: kouloughli
 * Date: 2/10/20
 * Time: 3:50 PM
 */

namespace Kouloughli\Http\Controllers\Web\Files;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Kouloughli\File;
use Kouloughli\Helpers\Helper;
use Kouloughli\Http\Controllers\Controller;
use Kouloughli\Http\Requests\File\AuthorizeFileUpdate;
use Kouloughli\Http\Requests\File\CreateFileRequest;
use Kouloughli\Http\Requests\File\CreateFileFromScannerRequest;
use Kouloughli\Http\Requests\File\UpdateFileRequest;
use Kouloughli\Repositories\Direction\DirectionRepository;
use Kouloughli\Repositories\File\FileRepository;
use Kouloughli\Support\Enum\FileImportance;
use Kouloughli\Traits\ManageImagesTrait;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FilesController extends Controller
{
    use ManageImagesTrait;

    /**
     * @var FileRepository
     */
    private $file;

    private $directions;

    private $currentClientIp;

    private $edit;


    /**
     * FilesController constructor.
     * @param FileRepository $file
     */
    public function __construct(Request $request ,FileRepository $file,DirectionRepository $directions)
    {

        $this->file = $file;
        $this->edit = false;
        $this->directions = $directions;
        $this->currentClientIp = $request->ip();
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $orderBy = $request->order_by ?: 'id';

        if($orderBy == 'last-updated'){
            $orderBy = 'updated_at';
        }elseif($orderBy == 'recent'){
            $orderBy = 'created_at';
        }

        $order   = $request->order ?: 'desc';

        $documents = auth()->user()->hasRole('Admin') ?
            $this->file->paginate(
            20,
            $request->search,
            $request->importance,
            $request->direction,
            $request->filter_date_arrivee,
            $orderBy,
            $order
        ) :
            $this->file->paginateForDirection(
                20,
                $request->search,
                $request->importance,
                $request->filter_date_arrivee,
                $orderBy,
                $order
            )
        ;
        return view('file-manager.index',[
            'documents' => $documents,
            'space' => Helper::diskSpace(),
            //'latests' => auth()->user()->hasRole('Admin') ? $this->file->latest(4) : $this->file->latestForDirection(4),
            'importances' => FileImportance::lists(),
            'pageNumbers' => FileImportance::pageNumbers(),
            'directions' => [0 => __('Select a Direction')] + $this->directions->lists()->toArray(),
            'currentClientIp' => $this->currentClientIp,
            'edit' => $this->edit

        ]);
    }

    /**
     * @param CreateFileRequest $request
     * @return mixed
     */
    public function store(CreateFileRequest $request)
    {
        $directionFolderPath = auth()->user()->direction->folder_path;

        $fileName = $this->uploadImage($request->file('file'),$directionFolderPath,'ged');
        $path = Storage::disk('ged')->path('/' .$directionFolderPath. '/' .$fileName);


        $fileData = $request->all() + [
                'file_size' => $request->file('file')->getSize(),
                'mime' => $request->file('file')->getClientMimeType(),
                'file_path' => $path,
                'file_name' => $fileName,
                'ref_user' => auth()->user()->ref_user,
                'date_arrivee' => Carbon::parse($request->date_arrivee)->format('Y-m-d')
        ];

        $this->file->create($fileData);

        return redirect()->route('files.index')
            ->withSuccess(__('File created successfully.'));

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function autocomplete(Request $request)
    {
        $search = $request->get('term');
        $data = $this->file->autocomplete($search);

        return response()->json($data);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function autocompletePrefetch(Request $request)
    {
        $data = auth()->user()->hasRole('Admin') ? $this->file->autocompletePrefetch(20) : $this->file->autoCompletePrefetchDirection(20);

        return response()->json($data);
    }


    /**
     * [documentScannerData description]
     * @param  CreateFileFromScannerRequest $request [description]
     * @return [type]           [description]
     */
    public function documentScannerData(CreateFileFromScannerRequest $request)
    {
        // Start Saving Form Details
        $data = $request->all();

        $documentScanned = $request->blob;

        $directionFolderPath = auth()->user()->direction->folder_path;

        $tmpFileName = $this->uploadImage($request->file('blob'),$directionFolderPath,'tempImages');

        $fileToConvert = Storage::disk('tempImages')->path('/' .$directionFolderPath. '/' .$tmpFileName);
        
        // Get The Converted File
        $fileName = $this->convertImageToPdf($fileToConvert,$directionFolderPath,'ged','tempImages',$tmpFileName);

        $path = Storage::disk('ged')->path('/' .$directionFolderPath. '/' .$fileName);

        $fileData = $request->all() + [
                'file_size' => $request->file('blob')->getSize(),
                'mime' => $request->file('blob')->getClientMimeType(),
                'file_path' => $path,
                'file_name' => $fileName,
                'ref_user' => auth()->user()->ref_user,
                'date_arrivee' => Carbon::parse($request->date_arrivee)->format('Y-m-d')
        ];

        $this->file->create($fileData);

        Session::flash('success', __('File created successfully.'));
    }


    /**
     * @param File $file
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(File $file,AuthorizeFileUpdate $request)
    {
        $this->edit = true;
        return view('file-manager.index',[
            'file' => $file,
            'space' => Helper::diskSpace(),
            'importances' => FileImportance::lists(),
            'pageNumbers' => FileImportance::pageNumbers(),
            'directions' => [0 => __('Select a Direction')] + $this->directions->lists()->toArray(),
            'currentClientIp' => $this->currentClientIp,
            'edit' => $this->edit,

        ]);
    }


    /**
     * @param UpdateFileRequest $request
     * @param File $file
     * @return mixed
     */
    public function update(UpdateFileRequest $request,File $file)
    {
        $data = $request->all();
        $this->file->update($file->id,$data);

        return redirect()->route('files.index')
            ->withSuccess(__('File updated successfully.'));
    }


    /**
     * Switch Between List and Grid View for user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function listView()
    {
        Session::has('list-view') ? Session::remove('list-view') : Session::put('list-view',true);

        return redirect()->route('files.index');
    }





}