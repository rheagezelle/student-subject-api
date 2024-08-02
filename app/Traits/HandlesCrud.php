<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait HandlesCrud
{
    abstract public function model();
    abstract public function rules();
    abstract public function resource();

    public function index()
    {
        $resource = $this->model()::all();

        return $this->resource()::collection($resource);
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), $this->rules())->validate();

        $resource = $this->model()::create($request->all());

        return new ($this->resource())($resource);
    }
    public function show($resource_id)
    {
        return $this->model()::findOrFail($resource_id);
    }
    public function update(Request $request, $resource_id)
    {
        $resource = $this->model()::findOrFail($resource_id);

        Validator::make($request->all(), $this->rules())->validate();

        $resource->update($request->all());

        return new ($this->resource())($resource);
    }
    public function destroy($resource_id)
    {
        $resource = $this->model()::findOrFail($resource_id);

        $resource->delete();

        return new ($this->resource())($resource);
    }
}