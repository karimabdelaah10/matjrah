@extends('BaseApp::layouts.company')
@section('title')
    <h6 class="slim-pagetitle">
        Company Profile Page
    </h6>
@endsection
@section('content')
    <div class="section-wrapper">
        <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered pull-left">
                <tr>
                    <td width="25%" class="align-left">{{trans('users.Name')}}</td>
                    <td width="75%" class="align-left">{{@$row->name}}</td>
                </tr>


                <tr>
                    <td width="25%" class="align-left">{{trans('users.Email')}}</td>
                    <td width="75%" class="align-left">{{@$row->email}}</td>
                </tr>

                <tr>
                    <td width="25%" class="align-left">{{trans('users.Mobile')}}</td>
                    <td width="75%" class="align-left">{{@$row->mobile_number}}</td>
                </tr>

                <tr>
                    <td width="25%" class="align-left">{{trans('users.Subdomain')}}</td>
                    <td width="75%" class="align-left">{{@$row->subdomain}}</td>
                </tr>

            </table>
        </div>
    </div>
@endsection
