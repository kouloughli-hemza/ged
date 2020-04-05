<?php

namespace Kouloughli\Repositories\File;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $query = File::query();

        if ($importance) {
            $query->where('importance', $importance);
        }

        if ($filterDateArrivee) {
            $query->where('date_arrivee', $filterDateArrivee);
        }

        $direction = Direction::find($direction);
        if ($direction) {
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
        $query = File::query();



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
        $query = File::query();

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
        return File::orderBy('created_at', 'desc')->limit($limit)->get();
    }


    public function autoCompletePrefetchDirection($limit = 20)
    {
        $direction = Auth::user()->direction;
        $query = File::query()->limit($limit);

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
        return File::orderBy('created_at', 'desc')->limit($limit)->get();

    }

    public function latestForDirection($limit = 4)
    {
        $direction = Auth::user()->direction;
        $query = File::query();
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
        return File::count();
    }

    public function filesPerMonth(Carbon $from, Carbon $to)
    {
        $result = File::whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get(['created_at'])
            ->groupBy(function ($file) {
                return $file->created_at->format("Y_n");
            });

        $counts = [];

        while ($from->lt($to)) {
            $key = $from->format("Y_n");

            $counts[$this->parseDate($key)] = count($result->get($key, []));

            $from->addMonth();
        }

        return $counts;
    }


    /**
     * Parse date from "Y_m" format to "{Month Name} {Year}" format.
     * @param $yearMonth
     * @return string
     */
    private function parseDate($yearMonth)
    {
        list($year, $month) = explode("_", $yearMonth);

        $month = trans("app.months.{$month}");

        return "{$month} {$year}";
    }


    /**
     * Get Files count uploaded by direction
     * @return array
     */
    public function directionsFiles()
    {
        $result = File::with('user')
            ->orderBy('created_at')
            ->get(['ref_user'])
            ->groupBy(function ($file) {
                return $file->user->direction->id_direc;
            });

        $counts = [];
        foreach ($result as $data){
            if(count($data) > 0){
                $counts[$data[0]->user->direction->direc_name] = count($data);
            }
        }
        asort($counts);
        return $counts;
    }

}
