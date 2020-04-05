<?php

namespace Kouloughli\Repositories\File;

use Carbon\Carbon;
use Kouloughli\File;

interface FileRepository
{
    /**
     * Get all system Files.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Paginate Files
     *
     * @param $perPage
     * @param null $search
     * @param null $importance
     * @return mixed
     */
    public function paginate($perPage, $search = null, $importance = null,$direction = null,$filterDateArrivee = null,$orderBy = 'id',$order = 'desc');


    /**
     * @param $perPage
     * @param null $search
     * @param null $importance
     * @param null $filterDateArrivee
     * @param string $orderBy
     * @param string $order
     * @return mixed
     */
    public function paginateForDirection($perPage, $search = null, $importance = null,$filterDateArrivee = null,$orderBy = 'id',$order = 'desc');


    /**
     * @param null $search
     * @return mixed
     */
    public function autocomplete($search = null);


    /**
     * Autocomplete Search for Admins
     * @param int $limit
     * @return mixed
     */
    public function autocompletePrefetch($limit = 20);

    /**
     * Autocomplete Search for direction
     * @param int $limit
     * @return mixed
     */
    public function autoCompletePrefetchDirection($limit = 20);


    /**
     * Find system File by id.
     *
     * @param $id File Id
     * @return File|null
     */
    public function find($id);

    /**
     * Find File by name:
     *
     * @param $name
     * @return mixed
     */
    public function findByName($name);

    /**
     * Create new system File.
     *
     * @param array $data
     * @return File
     */
    public function create(array $data);

    /**
     * Update specified File.
     *
     * @param $id File Id
     * @param array $data
     * @return File
     */
    public function update($id, array $data);

    /**
     * Remove File from repository.
     *
     * @param $id File Id
     * @return bool
     */
    public function delete($id);


    /**
     * Get latest 4 uploaded Documents
     * @param int $limit
     * @return mixed
     */
    public function latest($limit = 4);


    /**
     * Return The total count of documents Uploaded to the system
     * @return mixed
     */
    public function count();

    /**
     * @param int $limit
     * @return mixed
     */
    public function latestForDirection($limit = 4);


    /**
     * @param Carbon $from
     * @param Carbon $to
     * @return mixed
     */
    public function filesPerMonth(Carbon $from, Carbon $to);

    /**
     * Get Files of specific direction
     * @return mixed
     */
    public function directionsFiles();

}
