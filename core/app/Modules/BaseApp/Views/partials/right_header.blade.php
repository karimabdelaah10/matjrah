@if(auth()->user())
@if(@$notifications)
<!-- dropdown -->
<div class="dropdown dropdown-b">
    <a href="" class="header-notification" data-toggle="dropdown">
        <i class="icon ion-ios-bell-outline"></i>
        @if(!@$notifications->isEmpty())
        <span class="indicator"></span>
        @endif
    </a>
    <div class="dropdown-menu">
        <div class="dropdown-menu-header">
            <h6 class="dropdown-menu-title">{{trans('app.Notifications')}}</h6>
        </div>
        <!-- dropdown-menu-header -->
        <div class="dropdown-list">
            @foreach(@$notifications as $notification)
            <!-- loop starts here -->
            <a href="notifications/to/{{$notification->id}}" class="dropdown-link">
                <div class="media">
                    <div class="media-body">
                        <p>{{$notification->message}}</p>
                        <span>{{$notification->created_at}}</span>
                    </div>
                </div>
                <!-- media -->
            </a>
            <!-- loop ends here -->
            @endforeach
            <div class="dropdown-list-footer">
                <a href="notifications"><i class="fa fa-angle-down"></i>{{trans('app.Show All')}}</a>
            </div>
        </div>
        <!-- dropdown-list -->
    </div>
    <!-- dropdown-menu-right -->
</div>
<!-- dropdown -->
@endif
<div class="navigation-icon">
    <i class="fas fa-bell"></i>
</div>

<div class="dropdown dropdown-c">
    <a id="profile-button" href="#" class="logged-user" data-toggle="dropdown">
        {!! viewImage(auth()->user()->profile_picture,'small') !!}
        <span>{{ auth()->user()->name }}</span>
        <i class="fa fa-angle-down"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <nav class="nav">
{{--            <a href="/profile/edit" class="nav-link"><i class="icon ion-person"></i> {{ trans('app.Edit account') }}</a>--}}
            <a href="/auth/logout" class="nav-link"><i class="icon ion-forward"></i>{{ trans('app.Logout') }}</a>
        </nav>
    </div>
    <!-- dropdown-menu -->
</div>
{{--@include('BaseApp::partials.langSwitch')--}}
<!-- dropdown -->
@endif