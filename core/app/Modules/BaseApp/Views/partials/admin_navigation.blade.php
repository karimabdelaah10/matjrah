<li class="nav-item {{(request()->getRequestUri() == "/")?"active":""}}">
    <a class="nav-link" href="{{app()->make("url")->to('/')}}/">
        <i class="icon ion-ios-pie-outline"></i>
        <span>{{trans('navigation.Dashboard')}}</span>
    </a>
</li>
<li id="manage-button"
    class="nav-item with-sub mega-dropdown {{(request()->is('*/pages*' , '*/news*' , '*/countries*' , '*/users*','*/roles*'.'*/options*'))?"active":""}}">
    <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="true">
        <i class="icon ion-ios-analytics-outline"></i>
        <span> {{trans('navigation.Entities Management')}}</span>
    </a>
    <div class="sub-item">
        <div class="row">
            <div class="col-lg mg-t-30 mg-lg-t-0">
                <div class="row">
                    <div class="col">
                        <label class="section-label">{{trans('navigation.Companies')}}</label>
                        <ul>
                            <li class="{{(request()->is('*/companies*'))?"active":""}}">
                                <a href="/dashboard/companies">{{trans('navigation.Companies')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <label class="section-label">{{trans('navigation.Products')}}</label>
                        <ul>
                            <li class="{{(request()->is('*/products*'))?"active":""}}">
                                <a href="/dashboard/products">{{trans('navigation.Products')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
</li>