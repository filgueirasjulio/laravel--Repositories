<?php

namespace App\Repositories\Core;

use App\Repositories\Exceptions\NotEntityDefined;
use App\Repositories\Contracts\RepositoryInterface;
use DB;

class BaseQueryBuilderRepository implements RepositoryInterface
{
    protected $tb;
    protected $orderBy = [
        'column' => 'id',
        'order'  => 'DESC'
    ];

    public function __construct()
    {
        $this->tb = $this->resolveTable();
    }

    public function getAll()
    {
        return DB::table($this->tb)
                 ->orderBy($this->orderBy['column'], $this->orderBy['order'])
                 ->get();
    }

    public function findById($id)
    {
        return DB::table($this->tb)->find($id);
    }

    public function findWhere($column, $valor)
    {
        return DB::table($this->tb)
                            ->where($column, $valor)
                            ->get();
    }

    public function findWhereFirst($column, $valor)
    {
        return DB::table($this->tb)
                        ->where($column, $valor)
                        ->first();
    }

    public function paginate($totalPage = 10)
    {
        return DB::table($this->tb)
                  ->orderBy($this->orderBy['column'], $this->orderBy['order'])
                  ->paginate($totalPage);
    }

    public function store(array $data)
    {
        return DB::table($this->tb)->insert($data);
    }

    public function update($id, array $data)
    {
        return DB::table($this->tb)
                 ->where('id', $id)
                 ->update($data);
    }

    public function delete($id)
    {
        return DB::table($this->tb)
                ->where('id', $id)
                ->delete();
    }

    public function orderBy($column, $order = 'DESC')
    {
      $this->orderBy['column'] = $column;
      $this->orderBy['order'] = $order;

      return $this;
    }
    
    public function resolveTable()
    {
        if (!property_exists($this, 'table')) {
            throw new NotEntityDefined;
        }
        return $this->table;
    }
}