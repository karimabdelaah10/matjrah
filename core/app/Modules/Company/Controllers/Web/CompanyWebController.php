<?php

namespace App\Modules\Company\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Users\Models\CompanyLoginStatistics;
use App\Modules\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyWebController extends Controller
{

    public $model;
    public $views;
    public $module;

    public function __construct(User $model)
    {
        $this->views = 'Company::web';
        $this->title = trans('app.Company');
        $this->model = $model;
    }

    public function getLogin()
    {
        return view($this->views . '.login');
    }

    public function postLogin(Request $request, $subdomain)
    {
        $row = $this->model->where('subdomain', $subdomain)->where('email', $request->email)->first();
        if ($row) {
            if (Auth::attempt(request()->only('email', 'password'), request('remember_me'))) {
                CompanyLoginStatistics::firstOrCreate(
                    ['date' => now()->format('Y-m-d')],
                    ['company_id' => $row->id]
                );
                $data['row'] = $row;
                return view($this->views . '.profile', $data);
            }
        }
        flash()->error(trans('auth.Failed to login'));
        return back();
    }
}
