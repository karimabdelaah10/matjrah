@extends('BaseApp::layouts.master')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
    <button id="help-button" type="button" class="btn btn-info rounded-5">
        <span class="glyphicon glyphicon-search"></span>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-lg"
             viewBox="0 0 16 16">
            <path d="m10.277 5.433-4.031.505-.145.67.794.145c.516.123.619.309.505.824L6.101 13.68c-.34 1.578.186 2.32 1.423 2.32.959 0 2.072-.443 2.577-1.052l.155-.732c-.35.31-.866.434-1.206.434-.485 0-.66-.34-.536-.939l1.763-8.278zm.122-3.673a1.76 1.76 0 1 1-3.52 0 1.76 1.76 0 0 1 3.52 0z"/>
        </svg>
    </button>
        <a id="create-button" href="{{$module}}/create" class="btn btn-success">
            <i class="fa fa-plus"></i> {{trans('app.Create')}}
        </a>
</h6>
@endsection
@section('content')
    <form action="{{$module}}" method="get">
        <input type="text"
               name="search_key"
               class="form-control"
               value="{{request()->search_key}}"
               style="width: 50%;margin: auto" placeholder="Enter Search Key ....">
    </form>

    <div class="section-wrapper">
    @if (!$rows->isEmpty())
    <div class="table-responsive">
        <table class="table display responsive nowrap">
            <thead>
                <tr>
                    <th class="wd-15p">{{trans('products.ID')}} </th>
                    <th class="wd-15p">{{trans('products.Title')}} </th>
                    <th class="wd-15p">{{trans('products.Description')}} </th>
                    <th class="wd-15p">{{trans('products.Company')}} </th>
                    <th class="wd-15p">{{trans('products.Is Active')}} </th>
                    <th class="wd-15p">{{trans('users.Actions')}}</th>
                    <th class="wd-15p">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                <tr>
                    <td class="center">{{$row->id}}</td>
                    <td class="center">{{$row->title}}</td>
                    <td class="center">{{$row->description}}</td>
                    <td class="center">{{@$row->company->name}}</td>
                    <td class="center"><img src="img/{{($row->is_active)?'check.png':'close.png'}}"></td>
                    <td class="center">
                        @include('BaseApp::partials.actions' ,['actions'=>['edit' , 'view' ,'delete'] , $row])
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    {{trans("options.There is no results")}}
    @endif
</div>
@endsection
@push('js')
    <script>
        $('document').ready(function () {
            var guideStepsArray = [];

                guideStepsArray[0] = {
                target: '#create-button',
                content: "{{trans('help-guide.You can create a new product')}}"
            };

                guideStepsArray[1] = {
                target: '#create-view',
                content: "{{trans('help-guide.Want to get details of a specific projproductect, click the View button')}}",
                position: 'bottom'
            };

                guideStepsArray[2] = {
                target: '#create-edit',
                content: "{{trans('help-guide.From here you can edit the product details')}}",
                position: 'bottom'
            };

                guideStepsArray[3] = {
                target: '#create-delete',
                content: "{{trans('help-guide.Delete button will permanently delete the product, this action is not reversible')}}",
                position: 'bottom'
            };

            var into = new Anno(guideStepsArray);
            $('#help-button').on('click', function () {
                into.show();
            })


        });

    </script>
@endpush