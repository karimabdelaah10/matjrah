@include('BaseApp::form.input',['name'=>'title',
    'value'=> $row->title ?? null,
    'type'=>'text','attributes'=>['class'=>'form-control',
    'label'=>trans('partners.Title'),
    'placeholder'=>trans('partners.Title'),
    'required'=>1]])

@include('BaseApp::form.input',['name'=>'description',
    'value'=> $row->description ?? null,
    'type'=>'text','attributes'=>['class'=>'form-control',
    'label'=>trans('partners.Description'),
    'placeholder'=>trans('partners.Description'),
    'required'=>1]])

@include('BaseApp::form.select',[
    'name'=>'company_id',
    'value'=>$row->company_id ?? null,
    'options'=>$companies,
    'attributes'=>['class'=>'form-control select2',
    'label'=>trans('options.Type'),
    'placeholder'=>trans('options.Select type'),
    'required'=>1]])
@include('BaseApp::form.boolean',['name'=>'is_active','attributes'=>['label'=>trans('partners.Is active')]])
