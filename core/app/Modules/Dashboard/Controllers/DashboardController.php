<?php

namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Integration\Models\ApplicationInstallement;
use App\Modules\MortgageApplications\MortgageApplication;
use App\Modules\Payments\Models\Payment;
use App\Modules\Users\Models\CompanyLoginStatistics;
use App\Modules\Users\User;

class DashboardController extends Controller
{
    public $model;
    public $views;
    public $module;

    public function __construct()
    {
        $this->module = 'dashboard';
        $this->views = 'Dashboard';
    }

    public function getIndex()
    {
        $data['page_title'] = trans('app.Dashboard');
        $data['views'] = $this->views;
        $data['users'] = User::active()->count();
        $data['rows'] = array_count_values(CompanyLoginStatistics::orderBy('id', 'desc')->pluck('date')->toArray());
        return view($this->views . '::index', $data);
    }

}
