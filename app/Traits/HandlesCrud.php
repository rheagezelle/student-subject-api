<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait HandlesCrud
{
    abstract public function model();
    abstract public function rules();

    public function index()
    {
        return $this->model()::all();
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), $this->rules())->validate();

        return $this->model()::create($request->all());
    }
    public function show($resource_id)
    {
        return $this->model()::findOrFail($resource_id);
    }
    public function update(Request $request, $resource_id)
    {
        $resource = $this->model()::findOrFail($resource_id);

        Validator::make($request->all(), $this->rules())->validate();

        return $resource->update($request->all());
    }
    public function destroy($resource_id)
    {
        $resource = $this->model()::findOrFail($resource_id);

        return $resource->delete();
    }
}