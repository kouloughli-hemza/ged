<?php

namespace Kouloughli\Http\Controllers\Web;

use Kouloughli\Direction;
use Kouloughli\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kouloughli\Http\Requests\Direction\CreateDirectionRequest;
use Kouloughli\Http\Requests\Direction\RemoveDirectionRequest;
use Kouloughli\Http\Requests\Direction\UpdateDirectionRequest;
use Kouloughli\Repositories\Direction\DirectionRepository;
use Kouloughli\Repositories\Role\RoleRepository;
use Kouloughli\Repositories\User\UserRepository;
use Kouloughli\Support\Enum\DirectionStatus;
use Kouloughli\Support\Enum\UserStatus;

class DirectionsController extends Controller
{
    /**
     * @var DirectionRepository
     */
    private $directions;
    /**
     * @var UserRepository
     */
    private $user;
    /**
     * @var RoleRepository
     */
    private $role;

    /**
     * DirectionsController constructor.
     * @param DirectionRepository $directionRepository
     */
    public function __construct(DirectionRepository $directionRepository,UserRepository $userRepository,RoleRepository $roleRepository)
    {
        $this->middleware('auth');
        $this->directions = $directionRepository;
        $this->user = $userRepository;
        $this->role = $roleRepository;
    }

    /**
     * List Of all direction in GED Mila
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $directions = $this->directions->paginate($perPage = 20, $request->search, $request->status);

        $statuses = ['' => __('All')] + DirectionStatus::lists();

        return view('direction.list', compact('directions', 'statuses'));
    }


    /**
     * View Details for specific direction
     *
     * @param Direction $direction
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Direction $direction)
    {
        return view('direction.view',compact('direction'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('direction.add');
    }

    /**
     * @param CreateDirectionRequest $request
     * @return mixed
     */
    public function store(CreateDirectionRequest $request)
    {
        // When Direction is created by administrator, we will set his
        // status to Active by default.
        $data = $request->all() + [
                'direc_status' => DirectionStatus::ACTIVE,
                'folder_path' => $this->directions->generateDirectoryName(),
            ];
        $direction = $this->directions->create($data);

        // Create User for direction
        $role = $this->role->findByName('User');
        $userData = $request->all() + [
                'status' => UserStatus::ACTIVE,
                'id_direc' => $direction->id_direc,
                'role_id' => $role->ref_role,
                'email_verified_at' => now()
            ];
        $this->user->create($userData);

        return redirect()->route('directions.index')
            ->withSuccess(__('Direction created successfully.'));
    }


    /**
     * @param Direction $direction
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Direction $direction)
    {
        return view('direction.edit',[
            'edit' => true,
            'direction' => $direction,
            'statuses' => DirectionStatus::lists()
        ]);
    }


    /**
     * @param Direction $direction
     * @param UpdateDirectionRequest $request
     * @return mixed
     */
    public function update(Direction $direction,UpdateDirectionRequest $request)
    {
        $data = $request->all();
        $this->directions->update($direction->id_direc,$data);

        return redirect()->back()
            ->withSuccess(__('Direction updated successfully.'));
    }


    public function destroy(RemoveDirectionRequest $request,Direction $direction)
    {
        $userDirection = auth()->user()->direction;
        if ($userDirection->is($direction) || $direction->id_direc == 1 ) {
            return redirect()->route('directions.index')
                ->withErrors(__('You cannot delete you direction.'));
        }

        $this->directions->delete($direction->id_direc);

        //event(new Deleted($user));

        return redirect()->route('directions.index')
            ->withSuccess(__('User deleted successfully.'));
    }


}