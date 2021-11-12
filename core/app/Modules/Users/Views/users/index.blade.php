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
        @if(can('create-'.$module))
            <a id="create-button" href="{{$module}}/create" class="btn btn-success">
                <i class="fa fa-plus"></i> {{trans('app.Create')}}
            </a>
        @endif
        @if(can('view-'.$module))
            <a id="create-export" href="{{$module}}/export?{{@$_SERVER['QUERY_STRING']}}" class="btn btn-primary">
                <i class="fa fa-arrow-down"></i> {{trans('app.Export')}}
            </a>
        @endif

    </h6>
@endsection
@section('content')
    <div class="section-wrapper">
        @if(can('view-'.$module))


            @if (!$rows->isEmpty())
                <div class="table-responsive">
                    <table class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-5p">{{trans('users.ID')}} </th>
                            @if(! request('type'))
                                <th class="wd-10p">{{trans('users.Is Admin')}} </th>
                            @endif
                            <th class="wd-15p">{{trans('users.Name')}} </th>
                            <th class="wd-15p">{{trans('users.Email')}} </th>
                            <th class="wd-15p">{{trans('users.Mobile')}} </th>
                            <th class="wd-10p">{{trans('users.Confirmed')}} </th>
                            <th class="wd-15p">{{trans('users.Created at')}}</th>
                            <th class="wd-25p">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($rows as $row)
                            <tr>
                                <td class="center">{{$row->id}}</td>

                                @if(! request('type'))
                                    <td class="center"><img src="img/{{($row->is_admin)?'check.png':'close.png'}}"></td>
                                @endif

                                <td class="center">{{$row->full_name}}</td>
                                <td class="center">{{$row->email}}</td>
                                <td class="center">{{$row->mobile_number}}</td>
                                <td class="center">{{$row->confirmed ? trans('users.Confirmed') : trans('users.Not Confirmed')}}</td>
                                <td class="center">{{$row->created_at}}</td>
                                <td class="center">
                                    <?php
                                    $actions = ['view'];
                                    if (request('deleted') != 'yes') {
                                        if ($row->type != 'customer') {
                                            array_push($actions, 'edit');
                                        }
                                        array_push($actions, 'delete');
                                    }
                                    ?>
                                    @include('BaseApp::partials.actions' ,['actions'=>$actions , $row])
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                {{trans("users.There is no results")}}
            @endif
        @endif

        <br>
        {{ $rows->links() }}
    </div>
@endsection


@push('js')
    <script>
        $('document').ready(function () {
            var guideStepsArray = [];

            @if(can('create-'.$module))
                guideStepsArray[0] = {
                target: '#create-button',
                content: "{{trans('help-guide.You can create a new user account for anyone who will frequently use this dashboard')}}"
            };
            @endif

                    @if(can('view-'.$module))
                guideStepsArray[1] = {
                target: '#create-export',
                content: "{{trans('help-guide.Click on export button to export all users in xlsx file')}}"
            };
            @endif

                    @if(can('view-'.$module))
                guideStepsArray[2] = {
                target: '#create-view',
                content: "{{trans('help-guide.Want to get details of a specific user, click the View button')}}",
                position: 'bottom'
            };
            @endif

                    @if(can('edit-'.$module))
                guideStepsArray[3] = {
                target: '#create-edit',
                content: "{{trans('help-guide.From here you can edit the user details, this only available for the users created from dashboard')}}",
                position: 'bottom'
            };
            @endif

                    @if(can('delete-'.$module))
                guideStepsArray[4] = {
                target: '#create-delete',
                content: "{{trans('help-guide.Delete button will permanently delete the user, this action is not reversible')}}",
                position: 'bottom'
            };
            @endif

            var into = new Anno(guideStepsArray);
            $('#help-button').on('click', function () {
                into.show();
            })


        });

    </script>
@endpush
