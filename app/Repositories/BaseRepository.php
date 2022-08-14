<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface BaseRepository
{
    public function all($fields = ['*']);

    public function trashOnly();

    public function find($id);

    public function findTrash($id);

    public function findBy($field, $value);

    public function recent($limit);

    public function store(Request $request);

    public function update(Request $request, $id);

    public function toggle($id, $field);

	public function trash($id);

	public function restore($id);

	public function destroy($id);
}
