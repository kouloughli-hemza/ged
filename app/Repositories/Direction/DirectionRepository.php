<?php

namespace Kouloughli\Repositories\Direction;

use Kouloughli\Direction;
use Kouloughli\Repositories\Role\RoleRepository;
use Kouloughli\Repositories\User\UserRepository;

interface DirectionRepository
{
    /**
     * Get all system Directions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Paginate Directions
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */
    public function paginate($perPage, $search = null, $status = null);


    /**
     * Lists all system Directions into $key => $column value pairs.
     *
     * @param string $column
     * @param string $key
     * @return mixed
     */
    public function lists($column = 'direc_name', $key = 'id_direc');

    /**
     * Get all system Directions with number of users for each Direction.
     *
     * @return mixed
     */
    public function getAllWithUsersCount();

    /**
     * Find system Direction by id.
     *
     * @param $id Direction Id
     * @return Direction|null
     */
    public function find($id);

    /**
     * Find Direction by name:
     *
     * @param $name
     * @return mixed
     */
    public function findByName($name);

    /**
     * Create new system Direction.
     *
     * @param array $data
     * @return Direction
     */
    public function create(array $data);

    /**
     * Update specified Direction.
     *
     * @param $id Direction Id
     * @param array $data
     * @return Direction
     */
    public function update($id, array $data);

    /**
     * Remove Direction from repository.
     *
     * @param $id Direction Id
     * @return bool
     */
    public function delete($id);


    /**
     * Register Direction and create user for it (Sign Up)
     * @param array $data
     * @param RoleRepository $roles
     * @param UserRepository $users
     * @return mixed
     */
    public function directionRegistration(array $data,RoleRepository $roles,UserRepository $users);


    /**
     * Generate Random Unique directory Name for direction
     * @return mixed
     */
    public function generateDirectoryName();


    /**
     * Get Total Directions in System
     * @return mixed
     */
    public function count();

    /**
     * Total of unconfirmed Directions
     * @return mixed
     */
    public function countUnconfirmed();

    /**
     * Get Total Files for a direction
     * @param Direction $direction
     * @return mixed
     */
    public function totalFiles(Direction $direction);
    /**
     *
     * Generate random string to use as directory Name
     * @param int $length
     * @return mixed
     */
    public function generateString($length);
}
