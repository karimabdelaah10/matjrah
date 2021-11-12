<?php

namespace App\Modules\Products\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Requests\ProductsRequest;
use App\Modules\Users\User;

class ProductsController extends Controller
{

    public $model;
    public $views;
    public $module;

    public function __construct(Product $model)
    {
        $this->module = '/dashboard/products';
        $this->views = 'Products';
        $this->title = trans('app.Products');
        $this->model = $model;
        $this->rules = $model->rules;
    }

    public function getIndex()
    {
        $search_key = request()->search_key ?? null;
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.List') . " " . $this->title;
        $data['rows'] = $this->model
            ->where(function ($q) use ($search_key) {
                if (!empty($search_key)) {
                    $q->where('title', 'like', '%"' . $search_key . '"%');
                    $q->orWhere('description', 'like', '%"' . $search_key . '"%');
                }
            })
            ->orderBy('id', 'desc')
            ->get();
        return view($this->views . '::index', $data);
    }

    public function getCreate()
    {
        $data['module'] = $this->module;
        $data['views'] = $this->views;
        $data['page_title'] = trans('app.Create') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model;
        $data['companies'] = User::company()->active()->pluck('name', 'id');
        $data['row']->is_active = 1;
        return view($this->views . '::create', $data);
    }

    public function postCreate(ProductsRequest $request)
    {
        if ($row = $this->model->create($request->all())) {
            flash()->success(trans('app.Created successfully'));
            return redirect($this->module);
        }
        flash()->error(trans('app.failed to save'));
        return back();
    }
    public function getEdit($id)
    {
        $data['module'] = $this->module;
        $data['views'] = $this->views;
        $data['page_title'] = trans('app.Edit') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
        $data['companies'] = User::company()->active()->pluck('name', 'id');
        return view($this->views . '::edit', $data);
    }
    public function postEdit(ProductsRequest $request, $id)
    {
        $row = $this->model->findOrFail($id);
        if ($row->update($request->all())) {
            flash(trans('app.Update successfully'))->success();
            return back();
        }
    }
    public function getView($id)
    {
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.View') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
        return view($this->views . '::view', $data);
    }
    public function getDelete($id)
    {
        $row = $this->model->findOrFail($id);
        $row->delete();
        flash()->success(trans('app.Deleted Successfully'));
        return redirect($this->module);
    }
}
