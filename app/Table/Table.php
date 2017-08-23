<?php

namespace App\Table;

use Illuminate\Database\Eloquent\Builder;

class Table
{
    private $rows = [];
    /**
    * @var Builder
    */
    private $model = null;
    private $modelOriginal = null;
    private $columns = [];
    private $perPage = 2;
    private $actions = [];
    private $filters = [];

    public function paginate($perPage)
    {
        $this->perPage= $perPage;
        return $this;
    }

    public function rows()
    {
        return $this->rows;
    }

    public function model($model = null)
    {
        if (!$model) {
            return $this->model;
        }
        $this->model = !is_object($model) ? new $model : $model;
        $this->modelOriginal = clone $this->model;
        return $this;
    }

    public function filters($filters)
    {
        $this->filters = $filters;
        return $this;
    }

    public function columns($columns = null)
    {
        if (!$columns) {
            return $this->columns;
        }
        $this->columns = $columns;
        return $this;
    }

    public function actions()
    {
          return $this->actions;
    }

    public function addAction($label, $route, $template)
    {
        $this->actions[]= [
          'label' => $label,
          'route' => $route,
          'template' => $template,
        ];
        return $this;
    }

    public function addEditAction($route, $template = null)
    {
        $this->addAction('Editar', $route, !$template ? 'table.edit_action' : $template);
        return $this;
    }

    public function addDeleteAction($route, $template = null)
    {
        $this->addAction('Excluir', $route, !$template ? 'table.delete_action' : $template);
        return $this;
    }


    public function search()
    {
        $keyName = $this->modelOriginal->getKeyName();
        $columns = collect($this->columns())->pluck('name')->toArray();
        array_unshift($columns, $keyName);
        $this->applyFilters();
        $this->rows = $this->model->paginate($this->perPage, $columns);
        return $this;
    }

    protected function applyFilters()
    {
        foreach ($this->filters as $filter) {
            $field = $filter['name'];
            $operator = $filter['operator'];
            $search = \Request::get('search');
            $search = strtolower($operator) === 'like' ? "%$search%" : $search;
            $this->model = $this->model->orWhere($field, $operator, $search);
        }
    }
}
