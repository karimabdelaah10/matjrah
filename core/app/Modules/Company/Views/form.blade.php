@include('BaseApp::form.input',['name'=>'name',
    'value'=> $row->name ?? null,
    'type'=>'text','attributes'=>['class'=>'form-control',
    'label'=>trans('users.Name'),
    'placeholder'=>trans('users.Name'),
    'required'=>1]])

@include('BaseApp::form.input',['name'=>'email','type'=>'email','attributes'=>['class'=>'form-control','label'=>trans('users.Email'),'placeholder'=>trans('users.Email'),'required'=>1]])
@include('BaseApp::form.input',['name'=>'mobile_number','type'=>'text','attributes'=>['class'=>'form-control','label'=>trans('users.Mobile'),'placeholder'=>trans('users.Mobile'),'required'=>1]])
@include('BaseApp::form.input',['name'=>'address','type'=>'text','attributes'=>['class'=>'form-control','label'=>trans('users.Address'),'placeholder'=>trans('users.Address'),'required'=>1]])

@include('BaseApp::form.password',['name'=>'password',
'attributes'=>
['class'=>'form-control','label'=>trans('users.password'),'placeholder'=>trans('users.password')]])
@include('BaseApp::form.password',
['name'=>'password_confirmation','attributes'=>
['class'=>'form-control','label'=>trans('users.password_confirmation'),'placeholder'=>trans('users.password_confirmation')]])
@include('BaseApp::form.boolean',['name'=>'is_active','attributes'=>['label'=>trans('partners.Is active')]])
