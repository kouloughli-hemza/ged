<?php

namespace Kouloughli\Repositories\File;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Kouloughli\Direction;
use Kouloughli\Events\File\Created;
use Kouloughli\Events\File\Deleted;
use Kouloughli\Events\File\Updated;
use Kouloughli\File;


class EloquentFile implements FileRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return File::all();
    }


    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $importance = null,$direction = null,$filterDateArrivee = null,$orderBy = 'id',$order = 'desc')
    {
        $query = File::with('user:ref_user,id_direc','user.direction:id_direc,direc_name');


        if ($importance) {
            $query->where('importance', $importance);
        }

        if ($filterDateArrivee) {
            $query->where('date_arrivee', $filterDateArrivee);
        }

        if ($direction) {
            $direction = Direction::find($direction);
            $query->where(function ($q) use ($direction) {
                $q->whereIn('ref_user', $direction->getUserIdsAttribute());
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('expiditeur', "like", "%{$search}%");
                $q->orWhere('destinataire', "like", "%{$search}%");
                $q->orWhere('objet', "like", "%{$search}%");
                $q->orWhere('communication_a', "like", "%{$search}%");
                $q->orWhere('sig_ext', "like", "%{$search}%");
                $q->orWhere('sig_int', "like", "%{$search}%");
                $q->orWhere('num_text', "like", "%{$search}%");
                $q->orWhere('num_enrg', "like", "%{$search}%");
            });
        }

        $result = $query->orderBy($orderBy, $order)
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        if ($importance) {
            $result->appends(['importance' => $importance]);
        }

        return $result;
    }


    public function paginateForDirection($perPage, $search = null, $importance = null, $filterDateArrivee = null, $orderBy = 'id', $order = 'desc')
    {

        $direction = Auth::user()->direction;
        $query = File::query()->with('user:ref_user,first_name,last_name,id_direc','user.direction:id_direc,direc_name');



        if ($importance) {
            $query->where('importance', $importance);
        }

        if ($filterDateArrivee) {
            $query->where('date_arrivee', $filterDateArrivee);
        }



        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('expiditeur', "like", "%{$search}%");
                $q->orWhere('destinataire', "like", "%{$search}%");
                $q->orWhere('objet', "like", "%{$search}%");
                $q->orWhere('communication_a', "like", "%{$search}%");
                $q->orWhere('sig_ext', "like", "%{$search}%");
                $q->orWhere('sig_int', "like", "%{$search}%");
                $q->orWhere('num_text', "like", "%{$search}%");
                $q->orWhere('num_enrg', "like", "%{$search}%");
            });
        }

        if ($direction) {
            $query->where(function ($q) use ($direction) {
                $q->whereIn('ref_user', $direction->getUserIdsAttribute());
            });
        }

        $result = $query->orderBy($orderBy, $order)
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        if ($importance) {
            $result->appends(['importance' => $importance]);
        }

        return $result;
    }


    public function autocomplete($search = null)
    {
        $query = File::with('user:ref_user,id_direc','user.direction:id_direc,direc_name')
            ->limit(10);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('expiditeur', "like", "%{$search}%");
                $q->orWhere('destinataire', "like", "%{$search}%");
                $q->orWhere('objet', "like", "%{$search}%");
                $q->orWhere('communication_a', "like", "%{$search}%");
                $q->orWhere('sig_ext', "like", "%{$search}%");
                $q->orWhere('sig_int', "like", "%{$search}%");
                $q->orWhere('num_text', "like", "%{$search}%");
                $q->orWhere('num_enrg', "like", "%{$search}%");
            });
        }

        if(!Auth::user()->hasRole('Admin')){
            $query->where(function ($q) {
                $q->whereIn('ref_user', Auth::user()->direction->getUserIdsAttribute());
            });
        }
        $result = $query->orderBy('id', 'desc')->get();

        return $result;

    }


    /**
     * @param int $limit
     * @return mixed
     */
    public function autocompletePrefetch($limit = 20)
    {
        return File::with('user:ref_user,id_direc','user.direction:id_direc,direc_name')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }


    public function autoCompletePrefetchDirection($limit = 20)
    {
        $direction = Auth::user()->direction;
        $query = File::query()
            ->with('user:ref_user,id_direc','user.direction:id_direc,direc_name')
            ->limit($limit);

        $query->where(function ($q) use ($direction) {
            $q->whereIn('ref_user', $direction->getUserIdsAttribute());
        });

        return $query->get();
    }


    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return File::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $file = File::create($data);

        event(new Created($file));

        return $file;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $file = $this->find($id);

        $file->update($data);

        event(new Updated($file));

        return $file;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $file = $this->find($id);

        event(new Deleted($file));

        return $file->delete();
    }




    /**
     * {@inheritdoc}
     */
    public function findByName($name)
    {
        return File::where('direc_name', $name)->first();
    }


    public function latest($limit = 4)
    {
        return File::with('user:ref_user,id_direc','user.direction:id_direc,direc_name')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();

    }

    public function latestWidget($limit = 4)
    {
        return File::with('user:ref_user,id_direc','user.direction:id_direc,direc_name')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function latestForDirection($limit = 4)
    {
        $direction = Auth::user()->direction;
        $query = File::query()->with('user:ref_user,id_direc','user.direction:id_direc,direc_name');
        if ($direction) {
            $query->where(function ($q) use ($direction) {
                $q->whereIn('ref_user', $direction->getUserIdsAttribute());
            });
        }
        $result = $query->orderBy('created_at', 'desc')->limit($limit)->get();

        return $result;

    }

    public function count()
    {
        return DB::table('files')->count();

    }


    /**
     * Get The total files for each month { Display it in dashboard Chart }
     * @param Carbon $from
     * @param Carbon $to
     * @return array|mixed
     */
    public function filesPerMonth(Carbon $from, Carbon $to)
    {
        $result = DB::select("SELECT DATE_FORMAT(created_at, '%m-%Y')
            created_at,count(created_at) as files_count from files 
            where (created_at BETWEEN '{$from}' AND '{$to}') 
            GROUP BY DATE_FORMAT(created_at, '%m-%Y') ");
        $data = [];
        foreach ($result as $key => $item){
            $data[$this->parseDate($item->created_at)] = $item->files_count;
        }
        return $data;

    }


    /**
     * Parse date from "Y_m" format to "{Month Name} {Year}" format.
     * @param $yearMonth
     * @return string
     */
    private function parseDate($yearMonth)
    {
        list($month, $year) = explode("-", $yearMonth);

        $month = trans("app.monthsql.{$month}");

        return "{$month} {$year}";
    }


    /**
     * Get Files count uploaded by direction
     * @return array
     */
    public function directionsFiles()
    {
        $result = DB::select("SELECT count(*) as direction_files_count,direc_name from files 
                    inner join users on users.ref_user = files.ref_user
                    inner join directions on directions.id_direc = users.id_direc
                    GROUP BY users.id_direc");
        $data = [];
        foreach ($result as $key => $item){
            $data[$item->direc_name] = $item->direction_files_count;
        }
        return $data;
    }

}
