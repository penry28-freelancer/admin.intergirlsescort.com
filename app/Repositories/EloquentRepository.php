<?php

namespace App\Repositories;

use Illuminate\Http\Request;

abstract class EloquentRepository implements BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = app()->make($this->model());
    }

    abstract public function model();

    public function all($fields = ['*'])
    {
        return $this->model->get($fields);
    }

    public function trashOnly()
	{
		return $this->model->onlyTrashed()->get();
	}

    public function find($id)
	{
		return $this->model->find($id);
	}

    public function findTrash($id)
    {
        return $this->model->onlyTrashed()->find($id);
    }

    public function findBy($field, $value)
    {
        return $this->model->where($field, $value)->first();
    }

    public function recent($limit)
    {
        return $this->mode->take($limit)->get();
    }

    public function store(Request $request)
    {
        $model = $this->model->create($request->all());

        if ($request->hasFile('images')) {
            foreach ($request->images as $type => $file) {
                $dir = config('image.dir.' . $this->model->getTable()) ?: config('image.dir.default');
                if (is_numeric($type)) {
                    $model->saveImage($file, $dir);
                } else {
                    $model->saveImage($file, $dir, $type);
                }
            }
        }

        return $model;
    }

    public function update(Request $request, $id)
    {
        $model = $this->model->find($id);
        $model->update($request->all());
        if ($request->input('delete_images')) {
            foreach ($request->delete_images as $type => $value) {
                $model->deleteImageTypeOf($type);
            }
        }
        if ($request->hasFile('images')) {
            $dir = config('image.dir.' . $this->model->getTable()) ?: config('image.dir.default');
            foreach ($request->images as $type => $file) {
                $model->updateImage($file, $dir, $type);
            }
        }
        return $this->model->find($id);
    }

    public function toggle($id, $field)
    {
        $model = $this->model->find($id);
        $status = $model->$field === 1 ? 0 : 1;
        $model->$field = $model->$field = $status;
        $model->save();
        return $status;
    }

    public function trash($id)
	{
		return $this->model->find($id)->delete();
	}

    public function restore($id)
	{
		return $this->model->onlyTrashed()->find($id)->restore();
	}

    public function destroy($id)
	{
		return $this->model->find($id)->forceDelete();
	}

    public function massTrash($ids)
	{
		return $this->model->whereIn('id', $ids)->delete();
	}

    public function massRestore($ids)
	{
		return $this->model->onlyTrashed()->whereIn('id', $ids)->restore();
	}

	public function massDestroy($ids)
	{
		return $this->model->whereIn('id', $ids)->forceDelete();
	}

	public function emptyTrash()
	{
		return $this->model->onlyTrashed()->forceDelete();
	}

    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        return $this->model->where($column, $operator, $value, $boolean);
    }
}
