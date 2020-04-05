<?php

namespace Kouloughli\Repositories\Direction;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Kouloughli\Direction;
use Kouloughli\Events\Direction\Created;
use Kouloughli\Events\Direction\Deleted;
use Kouloughli\Events\Direction\Updated;
use Kouloughli\Repositories\Role\RoleRepository;
use Kouloughli\Repositories\User\UserRepository;
use Kouloughli\Support\Enum\DirectionStatus;
use Kouloughli\Support\Enum\UserStatus;

class EloquentDirection implements DirectionRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Direction::all();
    }


    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = Direction::query();

        if ($status) {
            $query->where('direc_status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('direc_name', "like", "%{$search}%");
                $q->orWhere('direc_description', 'like', "%{$search}%");
                $q->orWhere('direc_email', 'like', "%{$search}%");
                $q->orWhere('direc_phone', 'like', "%{$search}%");
            });
        }

        $result = $query->orderBy('id_direc', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        if ($status) {
            $result->appends(['status' => $status]);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllWithUsersCount()
    {
        return Direction::withCount('users')->get();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Direction::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $direction = Direction::create($data);

        event(new Created($direction));

        return $direction;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $direction = $this->find($id);

        $direction->update($data);

        event(new Updated($direction));

        return $direction;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $direction = $this->find($id);

        event(new Deleted($direction));

        return $direction->delete();
    }


    /**
     * {@inheritdoc}
     */
    public function directionRegistration(array $data,RoleRepository $roles,UserRepository $users)
    {
        $direction = Direction::create($data);

        $this->createUserForDirection($data,$direction,$roles,$users);

        return $direction;
    }

    private function createUserForDirection(array $data,Direction $direction,RoleRepository $roles,UserRepository $users)
    {
        // Create User for direction
        $role = $roles->findByName('User');
        $userData = $data + [
                'status' => UserStatus::UNCONFIRMED,
                'id_direc' => $direction->id_direc,
                'role_id' => $role->ref_role,
                'email_verified_at' => now()
            ];
        $user = $users->create($userData);

        event(new Registered($user));

    }


    /**
     * {@inheritdoc}
     */
    public function lists($column = 'direc_name', $key = 'id_direc')
    {
        return Direction::pluck($column, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function findByName($name)
    {
        return Direction::where('direc_name', $name)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return Direction::count();
    }


    /**
     * @return mixed
     */
    public function countUnconfirmed()
    {
        return Direction::where('direc_status', DirectionStatus::NONACTIVE)->count();

    }


    public function totalFiles(Direction $direction)
    {
        return $direction->files()->count();
    }
    /**
     * @return mixed|string
     */
    public function generateDirectoryName()
    {
        $time = now()->timestamp;
        $random = strtolower($this->generateString(5));
        $directryName = $random . '_' . $time;
        return $directryName;
    }


    /**
     * @param int $length
     * @return mixed|string
     */
    public function generateString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
