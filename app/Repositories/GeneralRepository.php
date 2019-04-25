<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

class GeneralRepository
{
    protected $model;

    /**
     * GeneralRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * get total quantity;
     * @return int
     */
    public function getQty()
    {
        $data = $this->model->all()->count();
        return $data;
    }

    /**
     * @return array
     */
    public function getFillables()
    {
        return $this->model->getFillable();
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $data = $this->model
            ->orderBy('id', 'DESC')
            ->get();
        return $data;
    }

    /**
     * @param array $relations
     * @param int $page
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function getByRelations(array $relations, $page = 10)
    {
        $data = $this->model->with($relations)->orderBy('id', 'DESC')->get();
        return $data;
    }


    /**
     * @param array $relations
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function getByRelationsId(array $relations, $id)
    {
        $data = $this->model->with($relations)->where('id', $id)->first();
        return $data;
    }

    /**
     * @param array $relations
     * @param int $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByPagination(array $relations, $page = 10)
    {
        $data = $this->model->with($relations)->orderBy('id', 'DESC')->paginate($page);
        return $data;
    }

    /**
     * Add new data
     * @param array $attributes
     * @return object
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return array
     */
    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function getList() {
        return $this->model->get(['id', 'name']);
    }
}