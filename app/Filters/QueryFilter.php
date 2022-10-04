<?php

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $__request;
    protected $__builder;
    protected $__fillable;

    public function __construct(Request $request)
    {
        $this->__request = $request;
    }

    public function apply(Builder $builder): Builder
    {
        $this->__builder = $builder;
        $this->__fillable = $this->getModelFillable();

        foreach($this->filters() as $field => $value) {
             if(method_exists($this, $field)) {
                call_user_func_array([$this, $field], array_filter([$value]));
            }
        }
        return $this->__builder;
    }

    public function filters(): array
    {
        return $this->__request->all();
    }

    public function getModelFillable()
    {
        $model = $this->__builder->getModel();
        return $model->getFillable();
    }

    protected function __whereSingleOrMoreQueryValue($field, $query)
    {
        $values = explode(',', $query);
        if(count($values) > 1) {
            return $this->__orWheres($field, $values);
        } else {
            return $this->__builder->where($field, $query);
        }
    }

    protected function __orWheres($field, $values)
    {
        return $this->__builder->where(function ($q) use ($field, $values) {
            foreach ($values as $value) {
                $q = $q->orWhere($field, $value);
            }
            return $q;
        });
    }
}
