<?php

namespace App\Modules\Users\Controllers;

use App\Modules\Cars\Car;
use App\Modules\Users\Models\Customer;
use App\Modules\Users\Requests\CreateUserRequest;
use App\Modules\Users\Requests\UpdateUserRequest;
use App\Modules\Users\User;
use App\Modules\Users\UserEnums;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public $model;
    public $module, $views;

    public function __construct(User $model)
    {
        $this->module = 'users';
        $this->views = 'Users::users';
        $this->title = trans('app.Users');
        $this->model = $model;
    }

    public function getIndex()
    {
        $data['module'] = $this->module;
        $data['views'] = $this->views;

        $data['page_title'] = trans('app.List Users');
        $data['rows'] = $this->model->getData()->latest()->paginate();

        $data['rows']->appends(request(['type', 'deleted']));
        return view($this->views . '.index', $data);
    }

    public function getCreate()
    {
        authorize('create-' . $this->module);
        $data['module'] = $this->module;
        $data['views'] = $this->views;
        $data['page_title'] = trans('app.Create') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model;
        return view($this->views . '.create', $data);
    }

    public function postCreate(CreateUserRequest $request)
    {
        authorize('create-' . $this->module);
        //////////////////////////////// check type
        $request->type == 'admin' ? $is_admin = 1 : $is_admin = 0;
        ////////////////////////////////
        if ($row = $this->model->create(array_merge(
            $request->except(["work_type",
                "job_title",
                "company_name",
                "company_address",
                "employment_document",
                "utility_bill",
                'marital_status',
                'nationality_id',
                'national_id',
                'national_id_image_front',
                'national_id_image_back',
                'user_id']),
            ['is_admin' => $is_admin]))
        ) {
            $row->attachRole($request->role_id);
            Customer::updateOrCreate(["user_id"=>$row->id] , $request->only([
                "work_type",
                "job_title",
                "company_name",
                "company_address",
                "employment_document",
                "utility_bill",
                'marital_status',
                'nationality_id',
                'national_id',
                'national_id_image_front',
                'national_id_image_back',
                'user_id'
            ]));
            flash()->success(trans('app.Created successfully'));
            return redirect('/' . $this->module);
        }
        flash()->error(trans('app.failed to save'));
        return redirect('/' . $this->module);
    }


    public function getEdit($id)
    {
        authorize('edit-' . $this->module);
        $data['module'] = $this->module;
        $data['views'] = $this->views;
        $data['page_title'] = trans('app.Edit') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module.'?'.request()->getQueryString()];
        $data['row'] = $this->model->findOrFail($id);
        return view($this->views . '.edit', $data);
    }

    public function postEdit(UpdateUserRequest $request, $id)
    {
        authorize('edit-' . $this->module);
        $row = $this->model->findOrFail($id);
        //////////////////////////////// check type
        $request->type == 'admin' ? $is_admin = 1 : $is_admin = 0;
        $row->is_admin = $is_admin;
        if ($row->update($request->except(["work_type",
            "job_title",
            "company_name",
            "company_address",
            "employment_document",
            "utility_bill",
            'marital_status',
            'nationality_id',
            'national_id',
            'national_id_image_front',
            'national_id_image_back',
            'user_id']))) {

            Customer::updateOrCreate(["user_id"=>$row->id] , $request->only([
                "work_type",
                "job_title",
                "company_name",
                "company_address",
                "employment_document",
                "utility_bill",
                'marital_status',
                'nationality_id',
                'national_id',
                'national_id_image_front',
                'national_id_image_back',
                'user_id'
            ]));
            flash(trans('app.Update successfully'))->success();
            return redirect('/' . $this->module);
        }
        flash()->error(trans('app.failed to save'));
        return redirect('/' . $this->module);
    }

    public function getView($id)
    {
        authorize('view-' . $this->module);
        $data['views'] = $this->views;
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.View') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module.'?'.request()->getQueryString()];
        $data['row'] = $this->model->with('customer')->findOrFail($id);
        return view($this->views . '.view', $data);
    }

    public function getDelete($id)
    {
        authorize('delete-' . $this->module);
        $row = $this->model->findOrFail($id);
        $row->delete();
        flash()->success(trans('app.Deleted Successfully'));
        return back();
    }

    public function getExport()
    {
        authorize('view-' . $this->module);
        $rows = $this->model->getData()->get();
        if ($rows->isEmpty()) {
            flash()->error(trans('app.There is no results to export'));
            return back();
        }
       return $this->model->export($rows,$this->module, $this->model );
    }
}
