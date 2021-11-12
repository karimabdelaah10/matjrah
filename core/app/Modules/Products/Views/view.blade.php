@extends('BaseApp::layouts.master')
@section('title')
    <h6 class="slim-pagetitle">
        {{ @$page_title }}
    </h6>
@endsection
@section('content')
    <div class="section-wrapper">
        <a href="{{$module}}/edit/{{$row->id}}" class="btn btn-success">
            <i class="fa fa-edit"></i> {{trans('products.Edit')}}
        </a><br>
        <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered pull-left">
                <tr>
                    <td width="25%" class="align-left">{{trans('products.Title')}}</td>
                    <td width="75%" class="align-left">{{@$row->title}}</td>
                </tr>


                <tr>
                    <td width="25%" class="align-left">{{trans('products.Description')}}</td>
                    <td width="75%" class="align-left">{{@$row->description}}</td>
                </tr>

                <tr>
                    <td width="25%" class="align-left">{{trans('products.Company')}}</td>
                    <td width="75%" class="align-left">{{@$row->company->name}}</td>
                </tr>

                <tr>
                    <td width="25%" class="align-left">{{trans('products.Is active')}}</td>
                    <td width="75%" class="align-left"><img src="img/{{($row->is_active)?'check.png':'close.png'}}">
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
