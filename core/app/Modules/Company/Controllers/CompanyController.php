<?php

namespace App\Modules\Company\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Requests\CompanyRequest;
use App\Modules\Users\User;

class CompanyController extends Controller
{

    public $model;
    public $views;
    public $module;

    public function __construct(User $model)
    {
        $this->module = '/dashboard/companies';
        $this->views = 'Company';
        $this->title = trans('app.Company');
        $this->model = $model;
    }

    public function getIndex()
    {
        $search_key = request()->search_key ?? null;
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.List') . " " . $this->title;
        $data['rows'] = $this->model
            ->where(function ($q) use ($search_key) {
                if (!empty($search_key)) {
                    $q->where('name', 'like', '%"' . $search_key . '"%');
                    $q->orWhere('email', 'like', '%"' . $search_key . '"%');
                    $q->orWhere('mobile_number', 'like', '%"' . $search_key . '"%');
                    $q->orWhere('address', 'like', '%"' . $search_key . '"%');
                }
            })
            ->company()
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
        $data['row']->is_active = 1;

        return view($this->views . '::create', $data);
    }

    public function postCreate(CompanyRequest $request)
    {
        $request['type'] = 'company';
        $request['subdomain'] = $request->name;
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
        return view($this->views . '::edit', $data);
    }

    public function postEdit(CompanyRequest $request, $id)
    {
        $request['subdomain'] = $request->name;
        $row = $this->model->findOrFail($id);
        if ($row->update($request->all())) {
            flash(trans('app.Update successfully'))->success();
            return back();
        }
    }

    public function getDelete($id)
    {
        $row = $this->model->findOrFail($id);
        $row->delete();
        flash()->success(trans('app.Deleted Successfully'));
        return redirect($this->module);
    }
}
